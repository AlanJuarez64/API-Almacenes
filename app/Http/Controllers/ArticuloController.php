<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ArticuloController extends Controller
{
    public function VerTodo()
    {
        return Articulo::all();
    }


    public function Buscar($id){
        try{
            $articulo = Articulo::findOrFail($id);
            return response()->json($articulo);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Artículo no encontrado'], 404);
        }
    }

    public function Eliminar($id)
    {
        try {
            $articulo = Articulo::findOrFail($id);
            $articulo->delete();

            return response()->json(['message' => 'Artículo eliminado correctamente']);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Artículo no encontrado'], 404);
        }
    }



    public function Registrar(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:Clientes,id',
            'ID_Producto' => 'required|exists:Productos,ID_Producto',
            'Estado' => ['required', Rule::in(['En espera', 'En el almacen', 'En camino', 'Entregado'])],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } 

        $articulo = new Articulo([
            'id' => $request->input('id'),
            'ID_Producto' => $request->input('ID_Producto'),
            'Estado' => $request->input('Estado'),
        ]);
        $articulo->id = $request->input('id');  
        $articulo->Estado = $request->input('Estado');

        $articulo->save();

        return response()->json(['mensaje' => 'Artículo registrado correctamente']);
    }

    public function CambiarEstado(Request $request, $id){
        try {
            $request->validate([
                'Estado' => ['required', Rule::in(['En espera', 'En el almacen', 'En camino', 'Entregado'])], 
            ]);
            
            $articulo = Articulo::findOrFail($id);
            $articulo->update($request->all());
    
            return response()->json(['message' => 'Estado del artículo modificado correctamente']);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Artículo no encontrado'], 404);
        }
    }
}
