@extends('admin.home')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>{{$title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="/admin">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#"></a>{{$title}}</li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <form action="{{route('sliders.store')}}" method="POST" enctype="multipart/form-data" id="movie-form">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="form-group col-md-6">
                                    <label for="name" class="col-form-label">Tên phim</label>
                                    <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control" placeholder="Tên phim">
                                    <span class="error invalid-feedback name_error"></span>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-md-6">
                                    <label for="poster" class="col-form-label">Poster</label><br>
                                    <input type="file" name="upload" id="upload">
                                    <span class="error invalid-feedback poster_error"></span>
                                    <div id="image_show" class="mt-3 col-md-3 pl-0">
                                    </div>
                                    <input type="hidden" name="poster" id="poster">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Thêm slider</button>
                            </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
