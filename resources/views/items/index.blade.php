@extends('layouts.master')

@section('title', 'List Items')

@section('content')
    <div id="">
        <div class="card text-white mb-3">
            <div class="card-header bg-success"><i class="fa fa-list"></i> List Items </div>
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

                <div class="col-md-12">
                    <a href="{{ route('items.create') }}" class="btn btn-success mb-2"><i class="fa fa-plus"></i> Add
                        Item</a>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td>
                                            <a href="{{ route('items.show', $item) }}" class="btn btn-info">
                                                Show
                                            </a>
                                            <a href="{{ route('items.edit', $item) }}" class="btn btn-primary">
                                                Edit
                                            </a>
                                            <form action="{{ route('items.destroy', $item) }}" class="d-inline"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                                    Delete
                                                </button>
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
@endsection
