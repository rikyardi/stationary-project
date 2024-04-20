<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class pdfController extends Controller
{
    public function generatePdf(){
        $report = DB::table('requests')
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->join('items', 'items.id', '=', 'requests.item_id')
            ->select('items.id', 'items.nama_barang', 'items.harga', 'users.name', 'requests.*' )
            ->get();

            $data = [
            'title' => 'Stationary Request',
            'date'  => date('m/d/Y'),
            'report'  => $report
            ];
        $pdf = Pdf::loadView('pdf.reportStationary', $data);
        return $pdf->download('reportStationary.pdf');
    }
}
