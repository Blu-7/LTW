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


                    <form action="{{route('movies.store')}}" method="POST" enctype="multipart/form-data" id="movie-form">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="form-group col-md-12">
                                    <label for="name" class="col-form-label">Tên phim</label>
                                    <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control" placeholder="Tên phim">
                                    <span class="error invalid-feedback name_error"></span>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="description">Mô tả phim</label>
                                    <textarea style="resize:none" rows="4" name="description" class="form-control" id="description" placeholder="Mô tả phim">{{old('description')}}</textarea>
                                    <span class="error invalid-feedback description_error"></span>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-md-4">
                                    <label for="start_date" class="col-form-label">Ngày khởi chiếu</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="dd/mm/yyyy">
                                    <span class="error invalid-feedback start_date_error"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="end_date" class="col-form-label">Ngày kết thúc</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="dd/mm/yyyy">
                                    <span class="error invalid-feedback end_date_error"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="poster" class="col-form-label">Poster</label><br>
                                    <input type="file" name="upload" id="upload">
                                    <span class="error invalid-feedback poster_error"></span>
                                    <div id="image_show" class="mt-3 col-md-3 pl-0">

                                    </div>
                                    <input type="hidden" name="poster" id="poster">
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
        $(function () {
            $('#movie-form').validate({
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
                    poster: {
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
                    poster: {
                        required: "Vui lòng chọn poster phim",
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
