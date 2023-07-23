<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Almacen;

class AlmacenController extends Controller
{

    public function VerTodosLosAlmacenes()
    {
        return Almacen::all();
    }


    public function buscarAlmacen(Request $request)
    {

        $id = $request->input('id');

        $almacen = Almacen::find($id);

        if (!$almacen) {
            return response()->json(['error' => 'Almacén no encontrado'], 404);
        }

        return response()->json($almacen, 200);
    }

    
    public function RegistrarAlmacen(Request $request){
        $request->validate([
            'Capacidad' => 'required|integer|min:10'
        ]);

        $almacen = Almacen::create($request->all());
        $almacen->save();

        return response()->json(['message' => 'Almacén registrado con éxito.', 'almacen' => $almacen], 201);
    }

    public function EliminarAlmacen(Request $request)
    {
        $id = $request->input('id');
        $almacen = Almacen::find($id);

        if ($almacen) {
            $almacen->delete();
            return response()->json(['message' => 'Almacén eliminado correctamente'], 200);
        } else {
            return response()->json(['error' => 'Almacén no encontrado'], 404);
        }
    }

    public function ModificarDatosDeAlmacen(Request $request)
    {
        $id = $request->input('id');
        $request->validate([
            'Capacidad' => 'required|integer|min:10'
        ]);

        $almacen = Almacen::find($id);

        if (!$almacen) {
            return response()->json(['error' => 'Almacén no encontrado'], 404);
        }

        $almacen->update($request->all());

        return response()->json(['message' => 'Almacén modificado con éxito.', 'almacen' => $almacen], 200);
    }
}

