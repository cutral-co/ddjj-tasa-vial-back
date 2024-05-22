<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $routeName = $request->route()->getName();

            $user_id = $request->user_id;
            if ($routeName == 'internal_login') {
                if (is_email($request->email)) {
                    $user_id = UserController::get_user_id_by_email($request->email);
                } else {
                    $user_id = UserController::get_user_id_by_dni($request->email);
                }
            }

            $credentials = [
                'id' => $user_id,
                'password' => $request->password,
            ];

            if (!$token = \PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth::attempt($credentials)) {
                return sendResponse(null, 'credenciales invalidas', 401);
            }

            return $this->respondWithToken($token, $request);
        } catch (Exception $e) {
            $log = saveLog($e->getMessage(), get_class() . '::' . __FUNCTION__, $e->getTrace());
            return log_send_response($log);
        }
    }

    public function logout(Request $request)
    {
        try {
            $validator = Validator::make($request->only('token'), [
                'token' => 'required',
            ]);

            if ($validator->fails()) {
                return sendResponse(null, ['error' => $validator->errors()], 422);
            }

            \PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth::invalidate($request->token);

            return sendResponse('User has been logged out');
        } catch (Exception $e) {
            $log = saveLog($e->getMessage(), get_class() . '::' . __FUNCTION__, $e->getTrace());
            log_send_response($log);
        }
    }

    public function refresh()
    {
        try {
            $JWTAuth = \PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth::class;

            $data = [
                'token' => $JWTAuth::refresh(),
                'expires_in' => ($JWTAuth::factory()->getTTL() * 60 * 1000) + round(microtime(true) * 1000),
            ];

            return sendResponse($data);
        } catch (Exception $e) {
            $log = saveLog($e->getMessage(), get_class() . '::' . __FUNCTION__, $e->getTrace());
            log_send_response($log);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string  $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, Request $request)
    {
        $routeName = $request->route()->getName();

        $data = [
            /* Solo ingresa los datos del usuario si fue un internal_login */
            ...$this->getUserData($routeName),
            'token' => $token,
            'expires_in' => $this->getExpiresIn(),
        ];

        return sendResponse($data);
    }

    /** Obtiene los datos del usuario en funcion de la ruta que ingresa para hacer el login */
    protected function getUserData($routeName)
    {
        $user_data = [];

        if ($routeName == 'internal_login') {
            $id = auth()->user()->id;
            $user = User::where('id', $id)->first();
            $user->getAllPermissions();

            $response = UserController::getUserResponse($user->id);

            if (isset($response->message)) {
                return sendResponse(null, $response->message);
            }

            if ($response->error) {
                return sendResponse(null, $response->error);
            }

            $user_data = [
                ...$response->data['user_data'],
                ...$user->toArray(),
            ];
        }

        return $user_data;
    }
}
