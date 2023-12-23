@extends('layouts.master')

@section('title', 'Tambah Item')

@section('content')
    <div class="card mb-3">
        <div class="card-header bg-primary"><i class="fa fa-plus"></i> Tambah Item</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    {{-- Form untuk menambah item --}}
                    <form action="{{ route('items.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga:</label>
                            <input type="number" name="harga" id="harga" class="form-control" step="0.01"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok:</label>
                            <input type="number" name="stok" id="stok" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
