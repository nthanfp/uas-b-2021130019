@extends('layouts.master')

@section('title', 'Order')

@section('content')
    <div class="card mb-3">
        <div class="card-header bg-success text-white"><i class="fa fa-plus"></i> Add Item</div>
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    {{-- Form untuk menambah item --}}
                    <form action="{{ route('items.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="id">Item ID <span class="text-danger">*</span></label>
                            <input type="text" name="id" id="id" class="form-control" minlength="5"
                                maxlength="16" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama">Name <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga">Price <span class="text-danger">*</span></label>
                            <input type="number" name="harga" id="harga" class="form-control" step="0.01"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="stok">Stock <span class="text-danger">*</span></label>
                            <input type="number" name="stok" id="stok" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
