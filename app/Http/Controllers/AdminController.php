<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }

    public function showDataCategory(){
        $data = Category::all();
        return view('admin.dataCategory', compact('data'));
    }

    function storeDataCategory(Request $request)
    {
        Category::create([
            'nama_kategori' => $request->name,       
        ]);
        return redirect()->back();
    }

    function updateDataCategory(Request $request, $id) {
        Category::where('id', $id)
        ->where('id', $id)
            ->update([
                'nama_kategori' => $request->name,
            ]);
        return redirect()->back();
    }

    function destroyDataCategory($id){
        Category::where('id', $id)->delete();
        return redirect()->back();
    }

    public function showDataSupplier(){
        $data = Supplier::all();
        return view('admin.dataSupplier', compact('data'));
    }

    function storeDataSupplier(Request $request)
    {
        Supplier::create([
            'nama_supplier' => $request->name,
            'alamat'        => $request->alamat,
            'kontak'        => $request->kontak       
        ]);
        return redirect()->back();
    }

    function updateDataSupplier(Request $request, $id) {
        Supplier::where('id', $id)
        ->where('id', $id)
            ->update([
                'nama_supplier' => $request->name,
                'alamat'        => $request->alamat,
                'kontak'        => $request->kontak   
            ]);
        return redirect()->back();
    }

    function destroyDataSupplier($id){
        Supplier::where('id', $id)->delete();
        return redirect()->back();
    }
    public function showDataUser(){
        $data = User::all()->where('role', 'user');
        return view('admin.dataUser', compact('data'));
    }

    function storeDataUser(Request $request)
    {
        User::create([
            'name'      => $request->name,
            'email'     => $request->email, 
            'password'  => $request->password,      
        ]);
        return redirect()->back();
    }

    function destroyDataUser($id){
        User::where('id', $id)->delete();
        return redirect()->back();
    }

    public function showDataItem(){
    $data = DB::table('items')
            ->join('categories', 'categories.id', '=', 'items.kategori_id')
            ->join('suppliers', 'suppliers.id', '=', 'items.supplier_id')
            ->select('items.*', 'categories.nama_kategori', 'suppliers.*')
            ->get();
    $kategori = DB::table('categories')->get();
    $supplier = DB::table('suppliers')->get();
    return view('admin.dataItem', compact('data', 'kategori', 'supplier'));
    }

    function storeDataItem(Request $request)
    {
        Item::create([
            'nama_barang' => $request->nama,
            'kategori_id' => $request->kategori,
            'supplier_id' => $request->supplier,
            'harga'       => $request->harga,    
            'stok'        => $request->stok    
        ]);
        return redirect()->back();
    }

    function updateDataItem(Request $request, $id) {
        Item::where('id', $id)
        ->where('id', $id)
            ->update([
                'nama_barang' => $request->nama,
                'kategori_id' => $request->kategori,
                'supplier_id' => $request->supplier,
                'harga'       => $request->harga,    
                'stok'        => $request->stok   
            ]);
        return redirect()->back();
    }

    function destroyDataItem($id){
        Supplier::where('id', $id)->delete();
        return redirect()->back();
    }
}
