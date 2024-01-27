@extends('layouts.main')
@section('container')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<h2>LIHAT TRANSAKSI PEMBELIAN</h2>
<form action="/search" method="GET">
    <div class=" container-fluid">
        <div class="mb-3 mt-3">
            <label>Tanggal :</label>
            <input type="date" class="form-control" placeholder="" name="tgl_transaksi">
        </div>
        <div class="mb-3">
            <label>NPK:</label>
            <select class="form-select" aria-label="Default select example" name="npk">
                <option selected>pilih karyawan</option>
                @foreach ($npk as $nama )
                <option value="{{ $nama->npk }}">{{ $nama->npk  }} - {{ $nama->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Tipe Bayar:</label>
            <select class="form-select" aria-label="Default select example" name="bayar">
                <option selected value="">pilih tipe</option>
                <option value="1">Lunas</option>
                <option value="0">Cicil</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Search</button>
        <a href="/viewTrx" class="btn btn-primary">Clear</a>
    </div>
</form>
@endsection

@section('sub-container')
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Kode</th>
                <th scope="col">Item</th>
                <th scope="col">Qty</th>
                <th scope="col">Harga</th>
                <th scope="col">Total</th>
                <th scope="col">Tipe Bayar</th>
                <th colspan=2 scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lists as $trx)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <td>{{ $trx['nama'] }}</td>
                <td>{{ $trx['tanggal'] }}</td>
                <td>{{ $trx['kode'] }}</td>
                <td>{{ $trx['item'] }}</td>
                <td>{{ $trx['qty'] }}</td>
                <td>{{ $trx['harga'] }}</td>
                <td>{{ $trx['total'] }}</td>
                <td>{{ $trx['tipeBayar'] }}</td>
                <td> <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#myModal{{ $trx['id'] }}" data-id="{{ $trx['id'] }}">Edit</a></td>
                <td>
                    <form action="/delete/{{$trx['id']}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>

                <div class="modal fade" id="myModal{{ $trx['id'] }}" tabindex="-1" aria-labelledby="myModalLabel{{ $trx['id'] }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="myModalLabel">Edit Data Transaksi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/edit" method="POST" id="modal{{ $trx['id'] }}">
                                    @csrf
                                    @method('PUT')

                                    <div class=" mb-3">
                                        <label for="editTanggal" class="form-label">Tanggal:</label>
                                        <input type="date" class="form-control" name="tgl_transaksi" value="{{ $trx['tanggal'] }}" readonly>
                                        <input type="hidden" name="id" value="{{ $trx['id'] }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="editNama" class="form-label">Nama:</label>
                                        <input type="text" class="form-control" name="nama" value="{{ $trx['nama'] }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label>Harga:</label>
                                        <input type="text" class="form-control" placeholder="" name="harga" id="harga" value="{{ $trx['harga'] }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label>Qty:</label>
                                        <input type="text" class="form-control" placeholder="" name="qty" id="qty" value="{{ $trx['qty'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label>Total:</label>
                                        <input type="text" class="form-control" placeholder="" name="total" id="total" value="{{ $trx['total'] }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pwd">Bayar:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="bayar" id="bayar1" value="1">
                                            <label class="form-check-label" for="inlineCheckbox1">Lunas</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="bayar" id="bayar2" value="0">
                                            <label class="form-check-label" for="inlineCheckbox2">Cicil</label>
                                        </div>
                                    </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>


            </tr>
            @endforeach





        </tbody>
    </table>
</div>





@endsection