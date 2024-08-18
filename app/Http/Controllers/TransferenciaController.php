<?php

namespace App\Http\Controllers;

use App\Models\DeclaracionJurada;
use App\Models\Transferencia;
use Illuminate\Http\Request;

class TransferenciaController extends Controller
{
    /**
     * Para obtener todas las instancias de un modelo.
     */
    public function index()
    {
        try {

        } catch (\Exception $e) {
            $log = saveLog($e->getMessage(), get_class().'::'. __FUNCTION__, $e->getTrace());
            return log_send_response($log);
        }
    }

    /**
     * Para guardar una nueva instancia.
     */
    public function store(Request $request)
    {
        try {
            $trans = Transferencia::create($request->all());
            $dj = DeclaracionJurada::where('id', $trans->dj_id)->with(['items.derivado', 'user.person'])->first();
            $dj->append('transferencias');
            return sendResponse($dj);
        } catch (\Exception $e) {
            $log = saveLog($e->getMessage(), get_class().'::'. __FUNCTION__, $e->getTrace());
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
            $log = saveLog($e->getMessage(), get_class().'::'. __FUNCTION__, $e->getTrace());
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
            $log = saveLog($e->getMessage(), get_class().'::'. __FUNCTION__, $e->getTrace());
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
            $log = saveLog($e->getMessage(), get_class().'::'. __FUNCTION__, $e->getTrace());
            return log_send_response($log);
        }
    }
}
