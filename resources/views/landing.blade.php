@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div id="">
        <div class="card text-white mb-3">
            <div class="card-header bg-success"><i class="fa fa-home"></i> Home</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title">180</h2>
                                <p class="card-text">Jumlah Item</p>
                                <a href="#" class="btn btn-success">Lihat detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title">180</h2>
                                <p class="card-text">Jumlah Item</p>
                                <a href="#" class="btn btn-success">Lihat detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
