<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use App\CompanyAdmin;
use App\Company;


class RestApiController extends Controller
{
    /** Register user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $credentials = $request->only('name', 'email', 'password');

        $rules = [
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255|unique:users'
        ];
        $validator  = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()],415);
        }
        $name       = $request->name;
        $email      = $request->email;
        $password   = $request->password;

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'is_verified' => '1'
        ]);

        $token = $this->guard()->login($user);
        return $this->respondWithToken($token);
    }


    /**
     * API Login, on success return JWT Auth token
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }

        if (! $token =  $this->guard()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * API Recover Password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public  function updatePassword(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $password = Hash::make($request->password);
        User::where('id', $currentUser->id)->update(['password' => $password]);
        return response()->json(['success' => true, 'message' => 'Password updated successfully.']);

    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     * @param Request $request
     */
    public function logout() {
        $this->guard()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'status'        => 'success',
            'expires_in'   => $this->guard()->factory()->getTTL() * 60,
        ],200);
    }

    public function guard()
    {
        return Auth::guard('api');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get all companies
     */
    public function getCompanies()
    {
        try
        {
            $companies = Company::all();
            return response()->json([
                'success' => true,
                'todo' => $companies,
            ],200);

        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
    }

    /**
     * Get all admins with company details
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAdmins()
    {
        try
        {
            $company_admins = CompanyAdmin::with('company')
                ->get();
            return response()->json([
                'success' => true,
                'company_admins' => $company_admins,
            ],200);

        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCompany($id)
    {
        try
        {
            $todo = Company::destroy($id);

            return response()->json([
                'success' => true,
                'todo_id' => $id,
            ],200);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 401);
        }
    }

}
