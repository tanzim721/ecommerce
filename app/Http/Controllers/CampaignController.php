<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    public function campaign()
    {
        $brands = DB::table('brands')->get();
        
        $campaigns = DB::table('device_model')
            ->join('brands', 'device_model.brand_id', '=', 'brands.id')
            ->select('device_model.*', 'brands.name as brand_name')
            ->get();

            // dd($campaigns);

        return view('home.campaign.create', compact('brands', 'campaigns'));
    }
    

}
