<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DeclaracionJurada;
use Illuminate\Http\Request;
use PhpParser\Builder\Declaration;

class DeclaracionJuradaController extends Controller
{
    /**
     * Para obtener todas las instancias de un modelo.
     */
    public function index()
    {
        try {
        } catch (\Exception $e) {
            $log = saveLog($e->getMessage(), get_class() . '::' . __FUNCTION__, $e->getTrace());
            return log_send_response($log);
        }
    }

    public function mis_ddjj()
    {
        try {
            $dj = DeclaracionJurada::where('user_id', auth()->user()->id)->get();
            return sendResponse($dj);
        } catch (\Exception $e) {
            $log = saveLog($e->getMessage(), get_class() . '::' . __FUNCTION__, $e->getTrace());
            return log_send_response($log);
        }
    }

    /**
     * Para guardar una nueva instancia.
     */
    public function store(Request $request)
    {
        try {
            $body = $request->all();
            $body['user_id'] = auth()->user()->id;
            $dj = DeclaracionJurada::create($body);
            return sendResponse($dj);
        } catch (\Exception $e) {
            $log = saveLog($e->getMessage(), get_class() . '::' . __FUNCTION__, $e->getTrace());
            return log_send_response($log);
        }
    }

    /**
     * Para mostrar una instancia en específico.
     */
    public function show($id)
    {
        try {
        } catch (\Exception $e) {
            $log = saveLog($e->getMessage(), get_class() . '::' . __FUNCTION__, $e->getTrace());
            return log_send_response($log);
        }
    }

    /**
     * Para actualizar una instancia en específico.
     */
    public function update(Request $request, $id)
    {
        try {
        } catch (\Exception $e) {
            $log = saveLog($e->getMessage(), get_class() . '::' . __FUNCTION__, $e->getTrace());
            return log_send_response($log);
        }
    }

    /**
     * Para eliminar una instancia.
     */
    public function destroy($id)
    {
        try {
        } catch (\Exception $e) {
            $log = saveLog($e->getMessage(), get_class() . '::' . __FUNCTION__, $e->getTrace());
            return log_send_response($log);
        }
    }
}
