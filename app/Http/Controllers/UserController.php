<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserProductsResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Retrieves user information
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser()
    {
        $user = User::find(Auth::user()->id);
        return response()->json(['data' => $user], 200);
    }
}
