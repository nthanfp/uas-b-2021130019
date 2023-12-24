@extends('layouts.master')

@section('title', 'Edit Item')

@section('content')
    <div class="card mb-3">
        <div class="card-header bg-success text-white"><i class="fa fa-pencil"></i> Edit Item</div>
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
                    {{-- Form untuk mengedit item --}}
                    <form action="{{ route('items.update', $item) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Use PUT method for update --}}

                        <div class="form-group mb-3">
                            <label for="id">Item ID <span class="text-danger">*</span></label>
                            <input type="text" name="id" id="id" class="form-control"
                                value="{{ $item->id }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama">Name <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                value="{{ $item->nama }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="harga">Price <span class="text-danger">*</span></label>
                            <input type="number" name="harga" id="harga" class="form-control" step="0.01"
                                value="{{ $item->harga }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="stok">Stock <span class="text-danger">*</span></label>
                            <input type="number" name="stok" id="stok" class="form-control"
                                value="{{ $item->stok }}" required>
                        </div>

                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
