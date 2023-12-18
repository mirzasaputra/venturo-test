<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReportController extends Controller
{
    
    public function index(Request $request)
    {
        if($request->has('tahun') && $request->tahun != '') {
            $resultData = $this->getFinalData($request);
        } else {
            $resultData = null;
        }
        $data = [
            'title' => 'Laporan',
            'data' => $resultData,
            'tahun' => $request->has('tahun') ? $request->tahun : ''
        ];

        return view('report.index', $data);
    }

    private function getFinalData(Request $request)
    {
        $data = $this->mappingData($request);
        $categoriData = collect($this->getDataCategories()->object());

        $temp = $categoriData->groupBy('kategori')->map(function($item) use ($data) {
            return $item->map(function($item) use($data) {
                $tempData = [
                    'menu' => $item->menu,
                    'jan' => $data->where('menu', $item->menu)->where('month', '01')->sum('total'),
                    'feb' => $data->where('menu', $item->menu)->where('month', '02')->sum('total'),
                    'mar' => $data->where('menu', $item->menu)->where('month', '03')->sum('total'),
                    'apr' => $data->where('menu', $item->menu)->where('month', '04')->sum('total'),
                    'mei' => $data->where('menu', $item->menu)->where('month', '05')->sum('total'),
                    'jun' => $data->where('menu', $item->menu)->where('month', '06')->sum('total'),
                    'jul' => $data->where('menu', $item->menu)->where('month', '07')->sum('total'),
                    'ags' => $data->where('menu', $item->menu)->where('month', '08')->sum('total'),
                    'sep' => $data->where('menu', $item->menu)->where('month', '09')->sum('total'),
                    'okt' => $data->where('menu', $item->menu)->where('month', '10')->sum('total'),
                    'nov' => $data->where('menu', $item->menu)->where('month', '11')->sum('total'),
                    'des' => $data->where('menu', $item->menu)->where('month', '12')->sum('total'),
                    'total' => $data->where('menu', $item->menu)->sum('total')
                ];
    
                return $tempData;
            });
        });

        return $temp;
    }

    private function mappingData(Request $request)
    {
        $reportData = collect($this->getDataReport($request->tahun)->object());
        $categoriData = collect($this->getDataCategories()->object());
        $reportData = $reportData->map(function($item) use ($categoriData) {
            $temp = [
                'menu' => $item->menu,
                'month' => Carbon::createFromDate($item->tanggal)->format('m'),
                'category' => $categoriData->where('menu', $item->menu)->first()->kategori,
                'total' => $item->total
            ];
            return $temp;
        });

        return $reportData;
    }

    private function getDataReport($year)
    {
        try {
            $response = Http::get("http://tes-web.landa.id/intermediate/transaksi?tahun=$year");
            return $response;
        } catch(Exception $e) {
            dd($e);
        }
    }

    private function getDataCategories()
    {
        try {
            $response = Http::get('http://tes-web.landa.id/intermediate/menu');
            return $response;
        } catch(Exception $e) {
            dd($e);
        }
    }

    public function getMenu() 
    {
        return response()->json($this->getDataCategories()->object());
    }

    public function getTransaction(Request $request)
    {
        return response()->json($this->getDataReport($request->tahun)->object());
    }

    public function downloadExample(Request $request)
    {
        return response()->streamDownload(function() use ($request) {
            if($request->has('tahun') && $request->tahun != '') {
                $resultData = $this->getFinalData($request);
            } else {
                $resultData = null;
            }
            $data = [
                'title' => 'Laporan',
                'data' => $resultData,
                'tahun' => $request->has('tahun') ? $request->tahun : ''
            ];
    
            $view = view('report.index', $data);
            echo $view->render();
        }, 'example.php');
    }

}
