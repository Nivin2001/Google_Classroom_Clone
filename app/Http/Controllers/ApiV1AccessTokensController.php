<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiV1AccessTokensController extends Controller
{
    //

    public function index(Request $request)
    {
       if(!Auth::gurad('sanctum')->user()->tokenCan('classroom.read'))
       abort(403);
        return $request->user('sanctum')
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'=>['required','email'],
            'password'=>['required'],
            'abilities'=>['array']
        ]);

        $user=User::WhereEmail($request->email)->first();
        if($user&& Hash::check($request->password,$user->password)){
            $name=$request->post('device_name',$request->userAgent());
            $abilities=$request->post('abilities',['*']);
            $token=$user->createToken($name, $abilities,now()->addDays());

            return Response::json([
                'token'=>$token->plainTextToken,
                'user'=>$user,
            ],201);

        }

        return Response::json([
            'message'=>__('Invalid cardaintals'),
        ],401);


    }

    public function destroy($id =null)
    {
        $user=Auth::gurad('sanctum')->user();
        if($id)
        //Revoke (logout from current device)
        if($id== 'current'){
            $user->currentAccessToken()->delete();
        }else{
            $user->tokens()->destroy($id);

        }
        else{

            $user->tokens()->destroy();

        }
    }
}
