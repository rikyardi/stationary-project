<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Req;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestStationary;
class UserController extends Controller
{
    public function index() {
        return view('dashboard');
    }

    public function dataBarang() {
        $data = DB::table('items')
            ->join('categories', 'categories.id', '=', 'items.kategori_id')
            ->join('suppliers', 'suppliers.id', '=', 'items.supplier_id')
            ->select('items.id', 'items.nama_barang', 'items.harga', 'items.stok', 'categories.nama_kategori', 'suppliers.nama_supplier', 'suppliers.alamat', 'suppliers.kontak' )
            ->get();
        $approver = DB::table('users')->where('role', 'atasan')->get();
        return view('barang', compact('data', 'approver'));
    }

    public function dataRequest() {
        $data = DB::table('requests')
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->join('items', 'items.id', '=', 'requests.item_id')
            ->select('items.id', 'items.nama_barang', 'items.harga', 'users.name', 'requests.*' )
            ->get();
        return view('pengajuan', compact('data'));
    }

    function storeRequest(Request $request)
    {
        $userid = auth()->user()->id;
        DB::table('requests')->insert([
            'user_id' => $userid,
            'item_id' => $request->item_id,
            'jumlah'  => $request->qty,
            'tanggal_permintaan' => date('Y-m-d H:i:s'),
            'status' => 'Pending',
            'tanggal_approve' => Null,
            'approver_id' => $request->approver,
        ]);
        $atasan = $request->approver;
        $approver = DB::table('users')->select('email')->where('id', $atasan)->first();
        
        Mail::to($approver->email)->send(new RequestStationary());
        return redirect()->back();
    }
}
