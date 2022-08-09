<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackupController extends Controller
{
    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {

            return response()->json([
                'status' => 200,
                'user' => $user,
            ]);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'User Not Found',
            ]);
        }
    }
}
