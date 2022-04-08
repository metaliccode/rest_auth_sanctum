@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }} | Tambah Data</div>
                    {{-- form --}}
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Product</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter product name">
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" class="form-control" name="price" placeholder="Enter price of product">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar Image</label>
                                <input class="form-control" type="file" name="image" accept="image/*">
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                    {{-- end form --}}
                </div>
            </div>
        </div>
    </div>
@endsection
