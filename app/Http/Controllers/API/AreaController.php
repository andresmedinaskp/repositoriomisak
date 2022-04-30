<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Exist;
use Illuminate\Support\Facades\Validator;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
   
    public function index()
    { 
        $area =Area::all();
        return $area;
    }


    public function store(Request $request)
    {
        $validar= Validator::make($request->all(), [
            'name'=> 'required|unique:areas'
        ]);
        if(!$validar ->fails()){
            $area = new Area();
            
            $area->name = $request ->name;

            $area->save();

            return response()->json([
                'res'=> true,
                'mensaje' => 'area guardada' 
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
        $area = Area::where('id',$id)
        ->first();
        if (isset($area)){
            return response()->json([
                'res'=> true,
                'area' => $area 
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
            'name' => "required|unique:areas"
        ]);

        if(!$validar->fails()){
            $area = Area::find($id);
            if(isset($area)){
                $area->name= $request->name;

                $area->save();
                 return response()->json([
                'res'=> true,
                'mensaje' => 'area actualizada' 
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
        $area = Area::find($id);
        if(isset($area)){
            $area->delete();
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
