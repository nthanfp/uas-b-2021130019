@extends('layouts.master')

@section('title', 'Detail Item')

@section('content')
    <div class="card mb-3">
        <div class="card-header bg-success text-white"><i class="fa fa-eye"></i> Detail Item</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $item->id }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $item->nama }}</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>{{ $item->harga }}</td>
                            </tr>
                            <tr>
                                <th>Stok</th>
                                <td>{{ $item->stok }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $item->updated_at }}</td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- Tombol Edit dan Hapus (opsional) --}}
                    {{-- <a href="{{ route('items.edit', ['id' => $item->id]) }}" class="btn btn-primary">Edit</a> --}}
                    {{-- <form action="{{ route('items.destroy', ['id' => $item->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">Hapus</button>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
