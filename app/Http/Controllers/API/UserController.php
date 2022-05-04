<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Exist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationServiceProvider;
use Illuminate\Auth\Event\Logout;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return $user;
    }

    public function register(Request $request)
    {
        $validar= Validator::make($request->all(), [
            "name" => "required|unique:users",
            "full_name" => "required",
            "document_type" => "required",
            "document_number" => "required|unique:users",
            "certificate_misak" => "required|unique:users",
            "email" => "required|unique:users",
            "password" => "required",
            "rol_id" =>"required"
        ]);
        if(!$validar ->fails()){
            $user = new User();

            $user->name = $request ->name;
            $user->full_name = $request ->full_name;
            $user->document_type = $request ->document_type;
            $user->document_number = $request ->document_number;
            $user->certificate_misak = $request ->certificate_misak;
            $user->email = $request ->email;
            $user->password = Hash::make($request ->password);
            $user->rol_id = $request->rol_id;


            $user->save();

            return response()->json([
                'status' => 1,
                'res'=> true,
                'mensaje' => 'Usuario registrado con exito'
            ]);
        }else{
            return response()->json([
                'status' => 0,
                'res'=> false,
                'mensaje' => 'error entrada duplicada'
            ]);
        }
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email','=',$request->email)->first();
        if(isset ($user->id))
        {
            if(Hash::check($request->password,$user->password)){
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'status' => 1,
                    'msg' => 'Usuario logeado...',
                    'access_token' => $token,
                    'user_id' => $user->id,
                    'rolusr' => $user->rol_id,
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Password Incorrecto'
                ]);
            }
        }
        else
        {
            return response()->json([
                'status' => 0,
                'msg' => 'Usuario no Registrado'
            ]);
        }
    }

    public function userProfile()
    {
        return response()->json([
            'status' => 0,
            'msg' => 'Autenticando usuario',
            'data' => auth()->user()
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 0,
            'msg' => 'Cierre de sesion exitosa'
        ]);
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validar= Validator::make($request->all(), [
            "name" => "required|unique:users",
            "full_name" => "required",
            "document_type" => "required",
            "document_number" => "required|unique:users",
            "certificate_misak" => "required|unique:users",
            "email" => "required|unique:users",
            "password" => "required",
            "rol_id" =>"required"
        ]);
        if(!$validar ->fails()){
            $user = new User();

            $user->name = $request ->name;
            $user->full_name = $request ->full_name;
            $user->document_type = $request ->document_type;
            $user->document_number = $request ->document_number;
            $user->certificate_misak = $request ->certificate_misak;
            $user->email = $request ->email;
            $user->password = $request->password;
            $user->rol_id = $request->rol_id;


            $user->save();

            return response()->json([
                'res'=> true,
                'mensaje' => 'Usuario guardado'
            ]);
        }else{
            return response()->json([
                'res'=> false,
                'mensaje' => 'error entrada duplicada'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id',$id)
        ->first();
        if (isset($user)){
            return response()->json([
                'res'=> true,
                'user' => $user
            ]);
        }else{
            return response()->json([
                'res'=> false,
                'mensaje' => 'registro no encontrado'
            ]);
        }
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
        $validar= Validator::make($request->all(), [
            "name" => "required|unique:users,name,".$this->route('user')->id,
            "full_name" => "required",
            "document_type" => "required",
            "document_number" => "required|unique:users,document_number,".$this->route('user')->id,
            "certificate_misak" => "required|unique:users,certificate_misak,".$this->route('user')->id,
            "email" => "required|unique:users,email,".$this->route('user')->id,
            "password" => "required",
            "rol_id" =>"required" //se agrego id rol y se borro de tabla roles
        ]);

        if(!$validar->fails()){
            $user = User::find($id);
            if(isset($user)){
                $user->name = $request ->name;
                $user->full_name = $request ->full_name;
                $user->document_type = $request ->document_type;
                $user->document_number = $request ->document_number;
                $user->certificate_misak = $request ->certificate_misak;
                $user->email = $request ->email;
                $user->password = $request ->password;
                $user->rol_id = $request->rol_id;

                $user->save();
                 return response()->json([
                'res'=> true,
                'mensaje' => 'Usuario actualizado'
            ]);

            }else{
                return response()->json([
                    'res'=> false,
                    'mensaje' => 'error al actualizar'
                ]);
            }
        }else{
            return "entrada duplicada";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(isset($user)){
            $user->delete();
            return response()->json([
                'res'=> true,
                'mensaje' => 'exito al elimar'
            ]);
        }else{
            return response()->json([
                'res'=> false,
                'mensaje' => 'falla al elimar no se encontro registro'
            ]);
        }
    }
}
