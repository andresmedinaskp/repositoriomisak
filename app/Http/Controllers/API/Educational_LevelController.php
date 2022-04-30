<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Educational_Level;
use Illuminate\Validation\Rules\Exist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class Educational_LevelController extends Controller
{
    public function index()
    {
        $educational_level =Educational_Level::all();
        return $educational_level;
    }

   
    public function store(Request $request)
    {
        $validar= Validator::make($request->all(), [
            'name'=> 'required|unique:educational_levels'
        ]);
        if(!$validar ->fails()){
            $educational_level = new Educational_Level();
            
            $educational_level->name = $request ->name;

            $educational_level->save();

            return response()->json([
                'res'=> true,
                'mensaje' => 'Nivel de educacion creado' 
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
        $educational_level = Educational_level::where('id',$id)
        ->first();
        if (isset($educational_level)){
            return response()->json([
                'res'=> true,
                '$educational_level' => $educational_level 
            ]);
        }else{
            return response()->json([
                'res'=> false,
                'mensaje' => 'registro no encontrado' 
            ]);
        }
    }

   
    public function update(Request $request,$id)
    {
        $validar= Validator::make($request->all(), [
            'name' => "required|unique:educational_levels"
        ]);

        if(!$validar->fails()){
            $educational_level = Educational_level::find($id);
            if(isset($educational_level)){
                $educational_level->name= $request->name;

                $educational_level->save();
                 return response()->json([
                'res'=> true,
                'mensaje' => 'Nivel de educacion actualizado' 
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

   
    public function destroy(Request $request, $id)
    {
        $educational_level = Educational_level::find($id);
        if(isset($educational_level)){
            $educational_level->delete();
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
