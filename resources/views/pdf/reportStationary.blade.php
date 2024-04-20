<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>{{$title}}</title>
</head>
<body>
    <h2>Title : {{$title}}</h2>
    <h2>Date  : {{$date}}</h2>
    
    {{-- <table class="table table-striped table-bordered zero-configuration text-center mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Supplier</th>
                <th>Harga</th>
                <th>Qty</th>
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
                <td>{{$item->qty}}</td>
            </tr>
            @endforeach
        </tbody>
    </table> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>