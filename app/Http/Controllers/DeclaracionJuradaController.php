<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeclaracionJurada\StoreDeclaracionJuradaRequets;
use App\Models\Coeficiente;
use App\Models\DeclaracionJurada;
use App\Models\DeclaracionJuradaItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeclaracionJuradaController extends Controller
{
    /**
     * Para obtener todas las instancias de un modelo.
     */
    public function index()
    {
        try {
            $subQuery = DeclaracionJurada::select('user_id', 'periodo', DB::raw('MAX(rectificativa) as max_rectificativa'))
                ->groupBy('user_id', 'periodo');

            $djs = DeclaracionJurada::with(['items.derivado', 'user.person'])
                ->joinSub($subQuery, 'max_djs', function ($join) {
                    $join->on('ddjj.user_id', '=', 'max_djs.user_id')
                        ->on('ddjj.periodo', '=', 'max_djs.periodo')
                        ->on('ddjj.rectificativa', '=', 'max_djs.max_rectificativa');
                })
                ->orderBy('ddjj.periodo', 'desc')
                ->get();

            return sendResponse($djs);
        } catch (\Exception $e) {
            $log = saveLog($e->getMessage(), get_class() . '::' . __FUNCTION__, $e->getTrace());
            return log_send_response($log);
        }
    }

    public function mis_ddjj()
    {
        try {
            $djs = DeclaracionJurada::where('user_id', auth()->user()->id)
                ->with('items.derivado')
                ->orderBy('periodo', 'desc')
                ->orderBy('rectificativa', 'desc')
                ->get();

            return sendResponse($djs);
        } catch (\Exception $e) {
            $log = saveLog($e->getMessage(), get_class() . '::' . __FUNCTION__, $e->getTrace());
            return log_send_response($log);
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $items = $request->items;

            $body = $request->all();
            unset($body['items']);

            $body['user_id'] = auth()->user()->id;
            $body['fecha_presentacion'] = \Carbon\Carbon::now();

            $dj = DeclaracionJurada::where('periodo', $request->periodo)
                ->where('user_id', $body['user_id'])
                ->orderBy('rectificativa', 'desc')
                ->first();

            $body['rectificativa'] = $dj ? $dj->rectificativa + 1 : 0;

            $dj = DeclaracionJurada::create($body);

            foreach ($items as $item) {
                unset($item['id']);
                $item['dj_id'] = $dj->id;
                $dj->items()->create($item);
            }

            $dj->items;
            DB::commit();

            return $this->mis_ddjj();
        } catch (\Exception $e) {
            DB::rollBack();
            $log = saveLog($e->getMessage(), get_class() . '::' . __FUNCTION__, $e->getTrace());
            return log_send_response($log);
        }
    }

    /**
     * Para guardar una nueva instancia.
     */
    /* public function store(StoreDeclaracionJuradaRequets $request)
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
    } */

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

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $dj = DeclaracionJurada::findOrFail($request->id);
            $items = $request->items;

            $coef_01 = Coeficiente::where('name', 'coef_01')->first();

            if ($items) {
                $dj->total_precio = 0;
                foreach ($items as $item) {
                    $item['dj_id'] = $dj->id;
                    $item['precio_final'] = $item['precio'] * $coef_01->value;

                    $dj->items()->updateOrCreate(
                        [
                            'id' => isset($item['id']) ? $item['id'] : null
                        ],
                        $item
                    );

                    $dj->total_precio += ($item['precio_final'] * $item['volumen_m3'] * 1000);
                }
            }
            $dj->save();
            $dj->items;

            DB::commit();
            return sendResponse($dj);
        } catch (\Exception $e) {
            DB::rollBack();
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

    public function getConstanciaDJ(Request $request)
    {
        $dj = DeclaracionJurada::where('id', $request->id)->with('items.derivado')->with('user.person')->first();

        $pdf = Pdf::loadView("pdf.contancia_dj", [
            'dj' => $dj
        ]);

        return $pdf->download("constancia_$dj->periodo.pdf");
    }
}
