@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Detail Product</h1>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
                </div>

                <div class="card" style="width: 18rem;">
                    <img src="/image/{{ $product->image }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->price }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
