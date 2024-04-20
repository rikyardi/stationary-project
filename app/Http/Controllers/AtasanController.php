<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\AccRequest;
use App\Mail\rejectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Req;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestStationary;

class AtasanController extends Controller
{
    public function index() {
        return view('atasan.dashboard');
    }

    public function dataRequest() {
        $data = DB::table('requests')
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->join('items', 'items.id', '=', 'requests.item_id')
            ->select('items.id', 'items.nama_barang', 'items.harga', 'users.name', 'requests.*' )
            ->get();
        return view('atasan.pengajuan', compact('data'));
    }

    function AccRequest(Request $request, $id) {
            $userid = $request->userid;
            $email = DB::table('users')->select('email')->where('id', $userid)->first();

            DB::table('requests')->where('id', $id)
            ->update([
                'status' => 'Approved',
            ]);

            Mail::to($email->email)->send(new AccRequest());
            return redirect()->back();

        }

    function RejectRequest(Request $request, $id) {
        $userid = $request->userid;
        $email = DB::table('users')->select('email')->where('id', $userid)->first();

        DB::table('requests')->where('id', $id)
            ->update([
                'status' => 'Rejected',
            ]);
            Mail::to($email->email)->send(new rejectRequest());
            return redirect()->back();
        }
}
