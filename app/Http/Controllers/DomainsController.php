<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DomainsController extends Controller
{
    protected $request;

    public function showMainPage()
    {
        return view('main');
    }
    
    public function showDomain($id)
    {
        $domain = DB::table('domains')->find($id);
        return view('domain', ['domain' => $domain]);
    }

    public function addDomain(Request $request)
    {
        $url = $request->input('url');
        $time = Carbon::now();     
        $id = DB::table('domains')->where('name', $url)->value('id');       
        if ($id) {
            DB::table('domains')->where('name', $url)->update(['updated_at' => $time]);            
        } else {
            $id = DB::table('domains')->insertGetId(
                ['name' => $url, 
                 'created_at' => $time,
                 'updated_at' => $time
            ]);
        }
        return redirect()->route('showDomain', ['id' => $id]);
    }
}
