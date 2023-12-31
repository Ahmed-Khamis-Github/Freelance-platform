<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Config as ModelsConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config ;
use Illuminate\Support\Facades\Cache ;

class ConfigController extends Controller
{
    public function index()
    {
        return view('config');
    }

    public function store(Request $request)
    {
        // save config to database
        foreach ($request->post('config') as $name => $value) {
            ModelsConfig::where('name', '=', $name)
                ->update([
                    'value' => $value,
                ]);
        }

        // clear cahce
        Cache::forget('configs');

        return redirect()->route('config')
            ->with('success', 'Config saved!');
    }
}
