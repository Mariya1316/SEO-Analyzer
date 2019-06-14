<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Validator;

class DomainsController extends Controller
{
    protected $request;

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
        $time = Carbon::now();
        $id = DB::table('domains')->where('name', $url)->value('id');
        if ($id) {
            DB::table('domains')->where('name', $url)
                ->update(['updated_at' => $time]);
        } else {
            $id = DB::table('domains')->insertGetId(
                [
                    'name' => $url,
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
