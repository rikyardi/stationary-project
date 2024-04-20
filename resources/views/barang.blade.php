@extends('layout')

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
                                    <th>Kategori</th>
                                    <th>Supplier</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
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
                                    <td>{{$item->nama_kategori}}</td>
                                    <td>{{$item->nama_supplier}}</td>
                                    <td>{{$item->harga}}</td>
                                    <td>{{$item->stok}}</td>
                                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalReq{{$item->id}}"><i class="fa fa-edit"></i> Ajukan</button></td>
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

@foreach ($data as $item)
<div class="modal fade" id="modalReq{{$item->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Form Pengajuan </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/store" method="post">
                @csrf
                <input type="hidden" name="item_id" value="{{$item->id}}">
                    <div class="mb-3">
                        <label for="InputBarang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="InputBarang" name="nama" value="{{$item->nama_barang}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="InputKategori" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="InputKategori" name="kategori" value="{{$item->nama_kategori}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="InputSupplier" class="form-label">Supplier</label>
                        <input type="text" class="form-control" id="InputSupplier" name="supplier" value="{{$item->nama_supplier}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="{{$item->harga}}" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="qty" class="form-label">Qty</label>
                        <input type="number" class="form-control" id="qty" name="qty" max="{{$item->stok}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="approver" class="form-label">Approver</label>
                        <select class="form-select" aria-label="Default select example" name="approver" required>
                            @foreach ($approver as $k)
                                <option value="{{$k->id}}">{{$k->name}}</option>
                            @endforeach
                        </select>    
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection