@extends('layouts.main')
@section('container')
<h2>TRANSAKSI PEMBELIAN</h2>
@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif
<form action="" method="POST" id=formTrx>
    @csrf
    <div class=" container-fluid">
        <div class="mb-3 mt-3">
            <label>Tanggal :</label>
            <input type="text" class="form-control" placeholder="" name="tgl_transaksi" value="{{ $now }}" readonly>
        </div>
        <div class="mb-3">
            <label>Nama:</label>
            <select class="form-select" aria-label="Default select example" name="npk">
                <option selected value="">pilih karyawan</option>
                @foreach ($npk as $nama )
                <option value="{{ $nama->npk }}">{{ $nama->npk  }} - {{ $nama->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Item:</label>
            <select class="form-select" aria-label="Default select example" id="pilihItem" name="kode">
                <option selected value="">pilih Item</option>
                @foreach ($mstItem as $item)
                <option value="{{ $item->kode }}" data-harga="{{ $item->harga }}">{{$item->kode}} - {{$item->nama_item}}</option>
                @endforeach

            </select>
        </div>
        <div class="mb-3">
            <label>Harga:</label>
            <input type="text" class="form-control" placeholder="" name="harga" id="harga" readonly>
        </div>
        <div class="mb-3">
            <label>Qty:</label>
            <input type="text" class="form-control" placeholder="" name="qty" id="qty">
        </div>
        <div class="mb-3">
            <label>Total:</label>
            <input type="text" class="form-control" placeholder="" name="total" id="total" readonly>
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
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-primary" onclick="clearForm()">Clear</button>
    </div>
</form>
@endsection