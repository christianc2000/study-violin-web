<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Contenido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ContenidoController extends BaseController
{
    public function listarTodo()
    {
        $contenidos = Contenido::all();
        $result = [
            'contenido' => $contenidos
        ];

        return $this->sendResponse($result, 'Contenidos obtenidos exitosamente');
    }
    public function listarDisponible()
    {
        $contenidos = Contenido::where('estado', true)->orderBy('posicion', 'asc')->get();
        $result = [
            'contenido' => $contenidos
        ];

        return $this->sendResponse($result, 'Contenido obtenidos exitosamente');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ejercicio_id' => 'required|exists:ejercicios,id',
            'imagen' => 'image|mimes:jpeg,png,jpg|max:10240',
            'descripcion' => 'required|string',
            'posicion' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Error de validación', $validator->errors(), 422); // 422 es el código de respuesta HTTP para errores de validación
        }

        try {
            if ($request->hasFile('imagen')) {
                $folder = "study_violin/Ejercicios";
                $url_p = Storage::disk('s3')->put($folder, $request->imagen, 'public');
                $url = Storage::disk('s3')->url($url_p);
                $contenido = Contenido::create(
                    [
                        'estado' => true,
                        'ejercicio_id' => (int)$request->ejercicio_id,
                        'url' => $url,
                        'descripcion' => $request->descripcion,
                        'posicion' => $request->posicion,
                    ]
                );

                return $this->sendResponse($contenido, 'Se creó el contenido exitosamente');
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
        $contenido = Contenido::find($id);
        if (isset($contenido)) {
            $contenido->estado = $request['estado'];
            $contenido->save();
            return $this->sendResponse($contenido, 'Se cambió el estado del contenido');
        } else {
            return $this->sendError('Error contenido no encontrado', [], 404);
        }
    }
    public function destroy($id)
    {
        $contenido = Contenido::find($id);
        if (isset($contenido)) {
            $contenido->delete();
            return $this->sendResponse($contenido, 'Se eliminó el contenido exitosamente');
        } else {
            return $this->sendError('Error contenido no encontrado', [], 404);
        }
    }
}
