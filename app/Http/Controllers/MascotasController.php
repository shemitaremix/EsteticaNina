<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Validaciones\ValidacionesCrud;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\ValidacionesCrud\validaciones;
use Illuminate\Support\Facades\Log;

class MascotasController extends Controller
{
    //
    use validaciones;
    /**
     * Funcion que nos obtine todos los registros de la tabla mascotas
     */
    public function obtenerMascotas()
    {
        try {
            //Obtenemos todos los registros de la tabla mascotas
            $Mascotas = Mascota::all();
            if (!$Mascotas) {
                return response()->json([
                    'error' => 'No se encontraron mascotas'
                ], 404);
                Log::channel('warning')->info('Tenemos un problema | No se encontraron mascotas en la base de datos || MascotasController@obtenerMascotas');
            }
            //Retornamos la informacion de las mascotas
            Log::channel('info')->info('Mascotas encontradas', ['Mascotas' => $Mascotas], 'MascotasController@obtenerMascotas');
            return response()->json(['estatus' => 'ok', 'mensaje' => 'Mascotas encontradas', 'Mascotas' => $Mascotas], 200);
        } catch (\Exception $e) {
            Log::channel('error')->error('Tenemos un problema | No se encontraron mascotas', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Funcion que registra una mascota
     */
    public function registrarMascota(Request $datos)
    {
        try {
            DB::beginTransaction();
            //Validacion de todos los datos recibidos
            $validaciones = Validator::make($datos->all(), $this->reglasValidacionesGenerales, $this->reglasValidacionesAgregarMascotas);
            if ($validaciones->fails()) {
                DB::rollBack();
                return response()->json([
                    'error' => $validaciones->errors()
                ], 404);
            }
            //Genereamos el registro de la mascota
            $Mascota = Mascota::create($datos->all());
            if ($Mascota == null) {
                DB::rollBack();
                return response()->json([
                    'error' => 'No se pudo registrar la mascota, intente de nuevo'
                ], 404);
            }
            //Se almacena la informacion de la mascota en la tabla mascotas
            DB::commit();
            return response()->json(['estatus' => 'ok', 'mensaje' => 'Mascota registrada', 'Mascota' => $Mascota], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Funcion que informa una mascota
     */
    public function informacionMacota($id)
    {
        try {
            //Obtenemos la informacion de la mascota
            $Mascota = Mascota::find($id);
            if (!$Mascota) {
                return response()->json([
                    'error' => 'No se encontro la mascota'
                ], 404);
            }
            //Retornamos la informacion de la mascota
            return response()->json(['estatus' => 'ok', 'mensaje' => 'Mascota encontrada', 'Mascota' => $Mascota], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Funcion que actualiza la informacion de una mascota
     * @param Request $datos
     */
    public function editarMascota(Request $request)
    {
        try {
            DB::beginTransaction();
            //Validacion de todos los datos recibidos
            $validaciones = Validator::make($request->all(), $this->reglasValidacionesGenerales, $this->reglasValidacionesEditarMascotas);
            if ($validaciones->fails()) {
                Log::channel('warning')->warning('Tenemos un problema | No se estamos recibiendo todos los datos necesrio || MascotasController@obtenerMascotas  ' . $validaciones->errors());
                DB::rollBack();
                return response()->json([
                    'error' => $validaciones->errors()
                ], 404);
            }
            //Obtenemos la informacion de la mascota
            $Mascota = Mascota::find($request->idEditar);
            if (!$Mascota) {
                DB::rollBack();
                Log::channel('warning')->warning('Tenemos un problema | No se encontro la mascota || MascotasController@editarMascota');
                return response()->json([
                    'error' => 'No se encontro la mascota'
                ], 404);
            }
            //Actualizamos la informacion de la mascota
            $Mascota->nombre = $request->nombreEditar;
            $Mascota->raza = $request->razaEditar;
            $Mascota->color = $request->colorEditar;
            $Mascota->edad = $request->edadEditar;
            $Mascota->save();
            //Se almacena la informacion de la mascota en la tabla mascotas
            DB::commit();
            Log::channel('info')->info('Mascota actualizada', ['Mascota' => $Mascota], 'MascotasController@editarMascota');
            return response()->json(['estatus' => 'ok', 'mensaje' => 'Mascota actualizada', 'Mascota' => $Mascota], 200);
        } catch (\Exception $e) {
            Log::channel('error')->error('Tenemos un problema | No se edito correctamente la mascota', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Funcion que elimina una mascota
     * @return json
     */
    public function eliminarMascota($id)
    {
        try {
            //Obtenemos la informacion de la mascota
            $Mascota = Mascota::find($id);
            if (!$Mascota) {
                return response()->json([
                    'error' => 'No se encontro la mascota'
                ], 404);
            }
            //Eliminamos la informacion de la mascota
            $Mascota->delete();
            //Retornamos la informacion de la mascota
            return response()->json(['estatus' => 'ok', 'mensaje' => 'Mascota eliminada', 'Mascota' => $Mascota], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
