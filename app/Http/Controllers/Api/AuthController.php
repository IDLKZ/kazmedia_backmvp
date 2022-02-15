<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\Models\User;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login',"register"]]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(ApiLoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Неправильный логин или пароль'], 401);
        }
        else{
            return $this->respondWithToken($token);

        }

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return [
            'user'=> auth('api')->user()
        ];
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth("api")->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


    public function register(ApiRegisterRequest $request){

        $input = $request->all();
        $input["role_id"] = 2;
        $input["status"] = 0;
        $input["password"] = bcrypt($input["password"]);
        $user = new User();
        try{
            if($user->fill($input)->save()){
                return response()->json(
                    [
                        "success"=>true,
                        "message"=>"Вы успешно зарегистрировались!"
                    ],200
                );
            }
            else{
                return response()->json(
                    [
                        "success"=>false,
                        "message"=>"Упс, что-то пошло не так"
                    ],401
                );
            }
        }
        catch (\Exception $exception){
                return response()->json(
                    [
                        "success"=>false,
                        "message"=>"Упс, что-то пошло не так"
                    ],401
                );

        }


    }
}
