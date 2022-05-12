<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Author_Material;
use Illuminate\Validation\Rules\Exist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class Author_MaterialController extends Controller
{
 
    public function index()
    {
        $author_material = Author_material::all();
        return $author_material;
    }

  
    public function store(Request $request)
    {
        $validar= Validator::make($request->all(), [
            'author_id'=> 'required',
            'material_id'=> 'required'
        ]);
        if(!$validar ->fails()){
            $author_material = new Author_material();
            
            $author_material->author_id = $request ->author_id;
            $author_material->material_id = $request ->material_id;

            $author_material->save();

            return response()->json([
                'res'=> true,
                'mensaje' => 'Guardado con exito' 
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
        $author_material = Author_material::where('id',$id)
        ->first();
        if (isset($author_material)){
            return response()->json([
                'res'=> true,
                'author_material' => $author_material 
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
            'author_id' => "required|unique:author__materials",
            'material_id' => "required|unique:author__materials"
        ]);

        if(!$validar->fails()){
            $author_material = Author_material::find($id);
            if(isset($author_material)){
                $author_material->author_id= $request->author_id;
                $author_material->material_id= $request->material_id;

                $author_material->save();
                 return response()->json([
                'res'=> true,
                'mensaje' => 'Se actualizado el registro' 
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
        $author_material = Author_material::find($id);
        if(isset($author_material)){
            $author_material->delete();
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
