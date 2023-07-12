<?php

namespace App\Http\Controllers;

use App\Interfaces\User\UserInterface;
use App\Models\NavigationMenu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function login(Request $request)
    {
        $validator = \validator($request->post(), [
            'email' => ['required'],
            'password' => 'required|min:4',
        ]);
        if ($validator->fails()) {
            return response($validator->errors()->first(), 422);
        }

        $credetanils = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credetanils)) {
            $user = Auth::user();
            $token = $user->createToken('terraform');

            return response()->json([
                'accessToken' => $token->plainTextToken,
                'user' => $user
            ]);


        } else {
            return response()->json(['password_check'=>false,'msg'=>"Credential not much"], 401);
        }


    }




}
