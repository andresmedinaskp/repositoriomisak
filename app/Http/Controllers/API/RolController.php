<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use Illuminate\Validation\Rules\Exist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RolController extends Controller
{
    
    public function index()
    {
        $rol =Rol::all();
        return $rol;
    }

   
    public function store(Request $request)
    {
        $validar= Validator::make($request->all(), [
            'name'=> "required|unique:rols"
            // 'user_id' => "required|unique:rols"
        ]);
        if(!$validar ->fails()){
            $rol = new Rol();
            
            $rol->name = $request ->name;
            // $rol->user_id = $request ->user_id;

            $rol->save();

            return response()->json([
                'res'=> true,
                'mensaje' => 'Rol guardado' 
            ]);
        }else{
            return response()->json([
                'res'=> false,
                'mensaje' => 'error entrada duplicada' 
            ]);
        }
    }

   
    public function show($id)
    {
        $rol = Rol::where('id',$id)
        ->first();
        if (isset($rol)){
            return response()->json([
                'res'=> true,
                'rol' => $rol 
            ]);
        }else{
            return response()->json([
                'res'=> false,
                'mensaje' => 'registro no encontrado' 
            ]);
        }
    }

    
    public function update(Request $request, $id)
    {
        $validar= Validator::make($request->all(), [
            'name' => "required|unique:rols"
            // 'user_id' => "required|unique:rols"
        ]);

        if(!$validar->fails()){
            $rol = Rol::find($id);
            if(isset($rol)){
                $rol->name= $request->name;
                // $rol->user_id= $request->user_id;

                $rol->save();
                 return response()->json([
                'res'=> true,
                'mensaje' => 'Rol actualizado' 
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

  
    public function destroy($id)
    {
        $rol = Rol::find($id);
        if(isset($rol)){
            $rol->delete();
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
