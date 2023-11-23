<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Estudio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EstudioController extends BaseController
{
    public function listarTodo()
    {
        $estudios = Estudio::all();
        $result = [
            'estudio' => $estudios
        ];

        return $this->sendResponse($result, 'Estudios obtenidos exitosamente');
    }
    public function listarDisponible()
    {
        $estudios = Estudio::where('estado', true)->orderBy('id', 'asc')->get();
        $result = [
            'estudio' => $estudios
        ];

        return $this->sendResponse($result, 'Estudios obtenidos exitosamente');
    }
    public function getPracticas($id)
    {
        $estudio = Estudio::find($id);
        if (isset($estudio)) {
            $practicas = $estudio->practicasEnabled;
            $result = [
                'practica' => $practicas
            ];
            return $this->sendResponse($result, 'Practicas encontradas');
        } else {
            return $this->sendError('Estudio no encontrado', [], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'nombre' => 'required|string',
            'puntos_requerido' => 'required|integer',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Error de validación', $validator->errors(), 422); // 422 es el código de respuesta HTTP para errores de validación
        }
        try {
            if ($request->hasFile('imagen')) {
                $folder = "study_violin/estudio";
                $url_p = Storage::disk('s3')->put($folder, $request->imagen, 'public');
                $url = Storage::disk('s3')->url($url_p);
                $estudio = Estudio::create([
                    'estado' => true,
                    'url' => $url,
                    'nombre' => $request->nombre,
                    'puntos_requerido' => (int)$request['puntos_requerido'],
                ]);

                return $this->sendResponse($estudio, 'Se creó el estudio exitosamente');
            } else {
                return $this->sendError('Error: No se proporcionó una imagen', [], 404);
            }
        } catch (\Exception $e) {
            return $this->sendError('Error al procesar la imagen', [], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'estado' => 'required|boolean',
            'imagen' => 'image|mimes:jpeg,png,jpg|max:10240',
            'nombre' => 'required|string',
            'puntos_requerido' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Error de validación', $validator->errors(), 422); // 422 es el código de respuesta HTTP para errores de validación
        }
        try {
            $estudio = Estudio::find($id);

            if (!$estudio) {
                return $this->sendError('Estudio no encontrado', [], 404);
            }

            if ($request->hasFile('imagen')) {
                Storage::disk('s3')->delete($estudio->url);
                $url_p = Storage::disk('s3')->put('study_violin/practica', $request->file('imagen'), 'public');
                $url = Storage::disk('s3')->url($url_p);
                $estudio->url = $url;
            }

            $estudio->estado = $request->estado;
            $estudio->nombre = $request->nombre;
            $estudio->puntos_requerido = $request->puntos_requerido;
            $estudio->save();
            return $this->sendResponse($estudio, 'Se actualizó el estudio');
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
        $estudio = Estudio::find($id);
        if (isset($estudio)) {
            $estudio->estado = $request['estado'];
            $estudio->save();
            return $this->sendResponse($estudio, 'Se cambió el estado del estudio');
        } else {
            return $this->sendError('Error estudio no encontrado', [], 404);
        }
    }
    public function destroy($id)
    {
        $estudio = Estudio::find($id);
        if (isset($estudio)) {
            $estudio->delete();
            return $this->sendResponse($estudio, 'Se eliminó el estudio exitosamente');
        } else {
            return $this->sendError('Error estudio no encontrado', [], 404);
        }
    }
}
