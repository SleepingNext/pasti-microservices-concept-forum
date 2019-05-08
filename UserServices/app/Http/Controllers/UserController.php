<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser($id) {
        $user = User::find($id);

        return response()->json($user);
    }
}
