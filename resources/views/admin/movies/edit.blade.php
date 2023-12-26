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
                        <li class="breadcrumb-item"><a href="/admin/movies/all">{{$menu}}</a></li>
                        <li class="breadcrumb-item"><a href="#"></a>{{$item}}</li>
                        <li class="breadcrumb-item active" aria-current="page">Cập nhật</li>
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
                        <h3 class="card-title">{{$item}}</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form action="/admin/movies/edit/{{$movie->id}}" method="POST" enctype="multipart/form-data" id="edit-movie-form">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="form-group col-md-12">
                                    <label for="category" class="col-form-label">Tên danh mục</label>
                                    <input type="text" name="name" value="{{$movie->name}}" class="form-control" placeholder="Tên danh mục">
                                    <span class="error invalid-feedback name_error"></span>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-md-12">
                                    <label class="col-sm-2 col-form-label">Mô tả danh mục</label>
                                    <textarea style="resize:none" rows="5" name="description" class="form-control" id="description" placeholder="Mô tả danh mục">{{$movie->description}}</textarea>
                                    <span class="error invalid-feedback description_error"></span>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-md-4">
                                    <label for="start_date" class="col-form-label">Ngày khởi chiếu</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="dd/mm/yyyy" value="{{$movie->start_date}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="end_date" class="col-form-label">Ngày kết thúc</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="dd/mm/yyyy" value="{{$movie->end_date}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="image" class="col-form-label">Poster</label><br>
                                    <div class="custom-file" name="image">
                                        <input type="file" class="custom-file-input" value="" id="upload" name="upload">
                                        <label class="custom-file-label" for="poster" name="file" id="file">{{str_replace('/storage/uploads/','', $movie->poster)}}</label>
                                        <input type="hidden" name="poster" value="{{$movie->poster}}" id="poster">
                                    </div>
                                    <div id="image_show" class="mt-3 col-md-3 pl-0">
                                        <a href=" {{ $movie->poster }}" target="_blank">
                                            <img src="{{ $movie->poster }}" width="100%" class="img-thumbnail">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Cập nhật</button>
                            <a class="btn btn-light" href="{{url()->previous()}}" onClick="">
                                <i class="fas fa-chevron-left mr-2"></i>
                                <span>Trở về</span>
                            </a>
                        </div>
                        @csrf
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <script>
        $(function () {
            $('#edit-movie-form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    start_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Vui lòng nhập tên phim",
                    },
                    description: {
                        required: "Vui lòng nhập mô tả Phim",
                    },
                    start_date: {
                        required: "Vui lòng chọn ngày khởi chiếu",
                    },
                    end_date: {
                        required: "Vui lòng chọn ngày kết thúc",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
