<?php

namespace App\Domains\Reportes\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\Reportes\Services\ReporteViaticosService;
use App\Domains\Reportes\Services\ReporteCombustibleService;
use App\Domains\Reportes\Services\ReporteRutasService;
use App\Domains\Reportes\Services\ReporteExportService;
use App\Domains\Reportes\Requests\ReporteRequest;

use Illuminate\Http\JsonResponse;

class ReporteController extends Controller
{
    protected $reporteViaticosService;
    protected $reporteCombustibleService;
    protected $reporteRutasService;
    protected $reporteExportService;

    public function __construct(ReporteViaticosService $reporteViaticosService, ReporteCombustibleService $reporteCombustibleService, ReporteRutasService $reporteRutasService, ReporteExportService $reporteExportService)
    {
        $this->reporteViaticosService = $reporteViaticosService;
        $this->reporteCombustibleService = $reporteCombustibleService;
        $this->reporteRutasService = $reporteRutasService;
        $this->reporteExportService = $reporteExportService;
    }

    ///  viaticos
    public function viaticosPorRuta($id): JsonResponse
    {
        $data = $this->reporteViaticosService->obtenerViaticosPorRuta($id);
        if (!$data) {
            return response()->json(['error' => 'Ruta no encontrada'], 404);
        }

        return response()->json($data);
    }

    // combustible
    public function combustiblePorRuta($id): JsonResponse
    {
        $data = $this->reporteCombustibleService->obtenerCombustiblePorRuta($id);
        if (!$data) {
            return response()->json(['error' => 'Ruta no encontrada'], 404);
        }

        return response()->json($data);
    }

    // rutas
    public function reporteCompletoPorRuta($id): JsonResponse
    {
        $viaticos = $this->reporteViaticosService->obtenerViaticosPorRuta($id);
        $combustible = $this->reporteCombustibleService->obtenerCombustiblePorRuta($id);

        if (!$viaticos && !$combustible) {
            return response()->json(['error' => 'Ruta no encontrada'], 404);
        }
        $data = [
            'viaticos' => $viaticos,
            'combustibles' => $combustible,
        ];
        return response()->json($data);
    }

    
    public function rutasConsumos(ReporteRequest $request)
    {
        $id = $request->input('id');
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
        $exportar = (int) $request->input('exportar', 0) === 1;
                
        // Caso 1: Si se envía el ID, obtenemos los datos por ID
        if ($id) {
            $ruta = $this->reporteRutasService->obtenerRutaPorId($id);
            if (!$ruta) {
                return response()->json(['error' => 'Ruta no encontrada'], 404);
            }
            $viaticos = $this->reporteViaticosService->obtenerTotalViaticosPorRuta($id);
            $combustible = $this->reporteCombustibleService->obtenerTotalCombustiblePorRuta($id);

            // Agregar los totales a la ruta
            $ruta->viaticos_sum_importe = $viaticos;
            $ruta->combustibles_sum_importe = $combustible;
            if ($exportar) {
                return $this->reporteExportService->exportarRutas([$ruta]);
            }

            return response()->json($ruta);
        }

        // Caso 2: Si se envían fechas, obtenemos los datos filtrados por rango de fechas
        $rutas = $this->obtenerRutasPorFechas($fechaInicio, $fechaFin);

        // Transformamos las rutas para agregar manualmente los totales de viáticos y combustible
        $rutas->getCollection()->transform(function ($ruta) {
            $ruta->total_viaticos = $this->reporteViaticosService->obtenerTotalViaticosPorRuta($ruta->id);
            $ruta->total_combustible = $this->reporteCombustibleService->obtenerTotalCombustiblePorRuta($ruta->id);
            $ruta->viaticos_sum_importe = $ruta->total_viaticos;
            $ruta->combustibles_sum_importe = $ruta->total_combustible;
            return $ruta;
        });

        if ($exportar === true) {
            return $this->reporteExportService->exportarRutas($rutas->items());
        }

        return response()->json($rutas);
    }

    private function obtenerRutasPorFechas($fechaInicio, $fechaFin)
    {
        if ($fechaInicio && $fechaFin) {
            return $this->reporteRutasService->obtenerRutasPorRangoDeFechas($fechaInicio, $fechaFin);
        } elseif ($fechaInicio) {
            return $this->reporteRutasService->obtenerRutasPorFecha($fechaInicio);
        } else {
            return $this->reporteRutasService->obtenerTodasLasRutasPaginadas();
        }
    }
}
