<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Almacen;

class AlmacenController extends Controller
{

    public function VerTodo()
    {
        return Almacen::all();
    }


    public function Buscar($id)
    {
        $almacen = Almacen::findOrFail($id);

        return response()->json($almacen, 200);
    }

    
    public function Registrar(Request $request){
        $request->validate([
            'Capacidad' => 'required|integer|min:10'
        ]);

        $almacen = Almacen::create($request->all());
        $almacen->save();

        return response()->json(['message' => 'Almacén registrado con éxito.', 'almacen' => $almacen], 201);
    }

    public function Eliminar($id)
    {
        $almacen = Almacen::findOrFail($id);
        $almacen->delete();
        
        return response()->json(['message' => 'Almacén eliminado correctamente'], 200);

        }

    public function ModificarDatos(Request $request, $id)
    {
        $request->validate([
            'Capacidad' => 'required|integer|min:10'
        ]);

        $almacen = Almacen::findOrFail($id);
        $almacen->update($request->all());

        return response()->json(['message' => 'Almacén modificado con éxito.', 'almacen' => $almacen], 200);
    }
    
}

