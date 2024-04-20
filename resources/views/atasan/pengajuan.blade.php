@extends('atasan.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration text-center mt-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Nama User</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Tanggal Permintaan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item->nama_barang}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->jumlah}}</td>
                                    <td>{{$item->harga}}</td>
                                    <td>{{$item->tanggal_permintaan}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>
                                        <form action="/atasan/approve/{{$item->id}}" method="post">
                                        @csrf
                                            <input type="hidden" name="userid" value="{{$item->user_id}}">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Approve</button>
                                        </form>
                                        <form action="/atasan/reject/{{$item->id}}" method="post">
                                            @csrf
                                            <input type="hidden" name="userid" value="{{$item->user_id}}">
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-edit"></i> Reject</button>
                                            </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection