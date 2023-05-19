<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ConflictException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\UserRegisterFormRequest;
use App\Models\User;
use App\Traits\RestResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use RestResponse;
   
    // https://www.youtube.com/watch?v=1e0ahYLmJjg
    public function register(UserRegisterFormRequest $request)
    {
        try {
            $password = $request->get('password');
            $request["password"] = Hash::make($password);
            $user = new User($request->all());
            // $request->password = Hash::make($request->password);
            $user->save();
            DB::commit();
            return $this->success($user);
            // return $this->information(__('messages.success'));
        } catch (\Exception $ex) {
            DB::rollBack();
            // throw new ConflictException(__($ex->getMessage()));
        }
        // return response()->json([
        //     "message"=>"Metodo de register ok"
        // ]);
    }

    public function login(LoginFormRequest $request)
    {
        if( Auth::attempt($request->toArray()) ) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $cookie = cookie('cookie_token', $token, 60*24);
            return $this->information($token)->withoutCookie($cookie);

        }
        throw new ConflictException(__('messages.error-credential-login'));
        // return response(["message"=>"Credenciales invalidas"], Response::HTTP_UNAUTHORIZED);
        
    }

    public function userProfile(Request $request)
    {
        return $this->information(auth()->user());
    }

    public function logout()
    {
        $cookie = Cookie::forget('cookie_token');
        auth()->user()->tokens()->delete();
        // $request->user()->token()->revoke();
        return $this->information(__('messages.logout'))->withCookie($cookie);

    }

    public function allUser(Request $request)
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
