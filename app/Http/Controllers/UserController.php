<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function loginAPI(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|exists:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return Response::ResponseBody(
                '200',
                null,
                null,
                $validator->errors()->all()
            );
        }
        $user = User::where('email', $request->email)->first();
        return Response::ResponseBody(
            '200',
            null,
            null,
            $user
        );
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {

            return Response::ResponseBody(
                '422',
                null,
                null,
                $validator->errors()->all()
            );
        }
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->toArray());
        return Response::ResponseBody(
            '200',
            null,
            null,
            $user
        );
    }
}
