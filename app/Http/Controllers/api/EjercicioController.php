<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Ejercicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EjercicioController extends BaseController
{
    public function listarTodo()
    {
        $ejercicios = Ejercicio::all()->where('tipo',1);
        $result = [
            'ejercicio' => $ejercicios
        ];

        return $this->sendResponse($result, 'Ejercicios obtenidos exitosamente');
    }
    public function listarDisponible()
    {
        $ejercicios = Ejercicio::where('estado', true)->where('tipo',1)->orderBy('posicion', 'asc')->get();
        $result = [
            'ejercicio' => $ejercicios
        ];

        return $this->sendResponse($result, 'Ejercicios obtenidos exitosamente');
    }
    public function getContenidos($id)
    {
        $ejercicio = Ejercicio::find($id);
        if (isset($ejercicio)) {
            $contenidos = $ejercicio->contenidosEnabled;
            $result = [
                'contenido' => $contenidos
            ];
            return $this->sendResponse($result, 'Contenidos encontradas');
        } else {
            return $this->sendError('Ejercicio no encontrado', [], 404);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'practica_id' => 'required|exists:practicas,id',
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'posicion' => 'required|integer',
            'puntos' => 'required|integer',
            'tipo'=>'required|numeric'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Error de validación', $validator->errors(), 422); // 422 es el código de respuesta HTTP para errores de validación
        }
        $ejercicio = Ejercicio::create(
            [
                'estado' => true,
                'practica_id' => (int)$request->practica_id,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'posicion' => (int)$request->posicion,
                'puntos' => (int)$request->puntos,
                'tipo'=>$request->tipo
            ]
        );
        return $this->sendResponse($ejercicio, 'Ejercicio creado exitosamente');
    }

    public function cambiarEstado($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estado' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Error de validación', $validator->errors(), 422); // 422 es el código de respuesta HTTP para errores de validación
        }
        $ejercicio = Ejercicio::find($id);
        if (isset($ejercicio)) {
            $ejercicio->estado = $request['estado'];
            $ejercicio->save();
            return $this->sendResponse($ejercicio, 'Se cambió el estado del ejercicio');
        } else {
            return $this->sendError('Error ejercicio no encontrado', [], 404);
        }
    }
    public function destroy($id)
    {
        $ejercicio = Ejercicio::find($id);
        if (isset($ejercicio)) {
            $ejercicio->delete();
            return $this->sendResponse($ejercicio, 'Se eliminó el ejercicio exitosamente');
        } else {
            return $this->sendError('Error ejercicio no encontrado', [], 404);
        }
    }
}
