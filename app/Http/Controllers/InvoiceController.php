<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Routing\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function printPdf(pesanan $pesan){
        return view ('/invoice',[
            'title' => 'Cetak',
            'pesan' => $pesan
        ]);
    }


    public function dwonloadPdf($id){

        $pesan = pesanan::where('id', $id)->first();

        $pdf = Pdf::loadView('invoice', compact('pesan'));
        $filename = "Nota Pesanan " .  $pesan->user->nama .'.pdf';
        return $pdf->stream($filename);
    }

    public function laporan(pesanan $pesans, Request $request){

        $searchOrder = $request->searchOrder;
        $searchOrder2 = $request->searchOrder2;

        $order = Pesanan::whereDate('tanggal_pinjam', '>=' , $searchOrder)
                          ->whereDate('tanggal_pinjam', '<=' , $searchOrder2)
                          ->get();


        $title = '';
        return view('laporan', [
        "title"  => "Laporan" .$title,
        'pesanans' => $order
        // "pesanans" => pesanan::latest()->filter(request(['searchOrder' , 'searchOrder2']))->get()
    ]);
    }
}
