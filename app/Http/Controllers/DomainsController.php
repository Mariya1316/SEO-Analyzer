<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Validator;
use GuzzleHttp\Client;
use DiDom\Document;

class DomainsController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function showMainPage()
    {
        return view('main', ['url' => '']);
    }

    public function showDomain($id)
    {
        $domain = DB::table('domains')->find($id);
        return view('domain', ['domain' => $domain]);
    }

    public function addDomain(Request $request)
    {
        $url = $request->input('url');
        $validator = Validator::make($request->all(), ['url' => 'required|url']);
        if ($validator->fails()) {
            $errorMessage = 'Invalid URL format. Example: http://site.com';
            return view('main', ['errorMessage' => $errorMessage, 'url' => $url]);
        }

        $response = $this->client->request('GET', $url);
        $responseCode = $response->getStatusCode();
        $body = (string)$response->getBody();
        $contentLength = $response->getHeader('Content-Length') ?
            $response->getHeader('Content-Length')[0] : 0;
        $doc = new Document($body);
        $h1 = $doc->has('h1') ? $doc->first('h1')->text() : 'No tag';
        $keywords = $doc->has('meta[name="keywords"]') ?
            $doc->first('meta[name="keywords"]')->attr('content') : 'No tag';
        $description = $doc->has('meta[name="description"]') ?
            $doc->first('meta[name="description"]')->attr('content') : 'No tag';
        $time = Carbon::now();

        $id = DB::table('domains')->where('name', $url)->value('id');
        if ($id) {
            DB::table('domains')->where('name', $url)->update(
                [
                    'response_code' => $responseCode,
                    'content_length' => $contentLength,
                    'h1' => $h1,
                    'keywords' => $keywords,
                    'description' => $description,
                    'body' => $body,
                    'updated_at' => $time
                ]
            );
        } else {
            $id = DB::table('domains')->insertGetId(
                [
                    'name' => $url,
                    'response_code' => $responseCode,
                    'content_length' => $contentLength,
                    'h1' => $h1,
                    'keywords' => $keywords,
                    'description' => $description,
                    'body' => $body,
                    'created_at' => $time,
                    'updated_at' => $time
                ]
            );
        }

        return redirect()->route('showDomain', ['id' => $id]);
    }

    public function showDomains()
    {
        $domains = DB::table('domains')->paginate(5);
        return view('domains', [
            'domains' => $domains,
            'paginate' => 'true'
        ]);
    }
}
