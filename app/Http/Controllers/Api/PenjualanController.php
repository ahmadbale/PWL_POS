<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PenjualanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class PenjualanController extends Controller
{
    public function __invoke(Request $request)
    {
        // remove token
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        if ($removeToken) {
            // return response JSON
            return response()->json([
                'success' => true,
                'message' => 'Logout Berhasil!',
            ]);
        }
    }
    public function index()
    {
        return PenjualanModel::all();
    }


    public function show(PenjualanModel $penjualan)
    {
        return PenjualanModel::find($penjualan);
    }


}