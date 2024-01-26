<?php

namespace App\Http\Controllers;

use App\Http\Requests\ {
    CreateUserRequest,
    LoginUserRequest,
};
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index() 
    {
        return User::all();
    }
    
    public function create(CreateUserRequest $createUserRequest) 
    {
        try {
            $user = User::Create($createUserRequest->validated());
            $token = $user->createToken('registration_token');
            return [
                'user' => $user,
                'token' => $token->plainTextToken,
            ];
        } catch (Exception $error) {
            return [
                'error' => $error,
            ];
        }
    }

    public function login(LoginUserRequest $loginUserRequest) 
    {
        try {
            $user = User::firstWhere('email', $loginUserRequest->email);
            $response = [
                'message' => 'These Credintials are not valid.',
            ];
            if ($user and Hash::check($loginUserRequest->password, $user->password)) {
                $token = $user->createToken('login_token');
                $response = [
                    'user' => $user,
                    'token' => $token->plainTextToken,
                ];
            }
            return $response;
        } catch (Exception $error) {
            return [
                'error' => $error,
            ];
        }
    }

    public function post(Request $request)
    {
        // add validated here
        return Auth::user()->posts()->create([
            'post_content' => $request->post_content
        ]);

    }

}
