@extends('admin.home')

@section('header')
<script src="/ckeditor/ckeditor.js"></script>
@endsection
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


                    <form action="{{route('movies.store')}}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="form-group col-md-12">
                                    <label for="name" class="col-form-label">Tên phim</label>
                                    <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control" placeholder="Tên phim">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="description">Mô tả phim</label>
                                    <textarea style="resize:none" rows="4" name="description" class="form-control" id="description" placeholder="Mô tả phim">{{old('description')}}</textarea>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-md-4">
                                    <label for="start_date" class="col-form-label">Ngày khởi chiếu</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="dd/mm/yyyy">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="end_date" class="col-form-label">Ngày kết thúc</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="dd/mm/yyyy">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="poster" class="col-form-label">Poster</label><br>
                                    <input type="file" name="poster" id="poster">
                                </div>
                            </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Thêm danh mục</button>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
