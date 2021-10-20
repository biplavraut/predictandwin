<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AdsResource;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    //
    public function index()
    {
        //        
        $data = Ads::latest()->paginate(10);
        return AdsResource::collection($data);
    }
}
