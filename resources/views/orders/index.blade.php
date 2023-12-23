@extends('layouts.master')

@section('title', 'Order')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header bg-success text-white"><i class="fa fa-shopping-cart"></i> Add New Order</div>
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

                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="items">Select Items</label>
                            <select name="items[]" id="items" class="form-control" multiple>
                                @foreach ($availableItems as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }} - Stok {{ $item->stok }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="quantities">Quantities</label>
                            <input type="number" name="quantities[]" id="quantities" class="form-control"
                                placeholder="Enter quantity" required>
                        </div>

                        <!-- Repeat the above two fields for each item -->

                        <button type="submit" class="btn btn-success">Submit Order</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header bg-success text-white"><i class="fa fa-list"></i> List Order</div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection
