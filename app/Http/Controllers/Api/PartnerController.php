<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PartnerResource;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    //
    public function index()
    {
        //
        $data = Partner::latest()->paginate(10);
        return PartnerResource::collection($data);
    }
}
