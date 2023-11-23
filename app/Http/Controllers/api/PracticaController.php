<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Practica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PracticaController extends BaseController
{
    public function listarTodo()
    {
        $practicas = Practica::all();
        $result = [
            'practica' => $practicas
        ];

        return $this->sendResponse($result, 'practicas obtenidos exitosamente');
    }
    public function listarDisponible()
    {
        $practicas = Practica::where('estado', true)->get();
        $result = [
            'practica' => $practicas
        ];

        return $this->sendResponse($result, 'practicas obtenidos exitosamente');
    }
    public function getEjercicios($id)
    {
        $practica = Practica::find($id);
        if (isset($practica)) {
            $ejercicios = $practica->ejerciciosEnabled;
            $result = [
                'ejercicio' => $ejercicios
            ];
            return $this->sendResponse($result, 'Ejercicios encontrados');
        } else {
            return $this->sendError('Practica no encontrado', [], 404);
        }
    }
    public function getEvaluaciones($id)
    {
        $practica = Practica::find($id);
        if (isset($practica)) {
            $evaluaciones = $practica->evaluacionesEnabled;
            $result = [
                'evaluacion' => $evaluaciones
            ];
            return $this->sendResponse($result, 'Evaluaciones encontrados');
        } else {
            return $this->sendError('Practica no encontrado', [], 404);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estudio_id' => 'required|exists:estudios,id',
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'nombre' => 'required|string',
            'cantidad_ejercicio' => 'required|integer',
            'cantidad_evaluacion' => 'required|integer',
            'cantidad_puntos' => 'required|integer',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Error de validación', $validator->errors(), 422); // 422 es el código de respuesta HTTP para errores de validación
        }
        try {
            if ($request->hasFile('imagen')) {
                $folder = "study_violin/practica";
                $url_p = Storage::disk('s3')->put($folder, $request->imagen, 'public');
                $url = Storage::disk('s3')->url($url_p);
                $practica = Practica::create([
                    'estado' => true,
                    'nombre' => $request->nombre,
                    'url' => $url,
                    'cantidad_ejercicio' => (int)$request->cantidad_ejercicio,
                    'cantidad_evaluacion' => (int)$request->cantidad_evaluacion,
                    'cantidad_puntos' => (int)$request->cantidad_puntos,
                    'estudio_id' => (int)$request->estudio_id
                ]);

                return $this->sendResponse($practica, 'Se creó el estudio exitosamente');
            } else {
                return $this->sendError('Error: No se proporcionó una imagen', [], 404);
            }
        } catch (\Exception $e) {
            return $this->sendError('Error al procesar la imagen', [], 500);
        }
    }

    public function cambiarEstado($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estado' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Error de validación', $validator->errors(), 422); // 422 es el código de respuesta HTTP para errores de validación
        }
        $practica = Practica::find($id);
        if (isset($practica)) {
            $practica->estado = $request['estado'];
            $practica->save();
            return $this->sendResponse($practica, 'Se cambió el estado del practica');
        } else {
            return $this->sendError('Error practica no encontrado', [], 404);
        }
    }
    public function destroy($id)
    {
        $practica = Practica::find($id);
        if (isset($practica)) {
            $practica->delete();
            return $this->sendResponse($practica, 'Se eliminó el practica exitosamente');
        } else {
            return $this->sendError('Error practica no encontrado', [], 404);
        }
    }
}
