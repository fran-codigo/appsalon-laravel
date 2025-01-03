<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getAdmin(Request $request) {
        $admin = $request->user();
        return $admin;
    }
}
