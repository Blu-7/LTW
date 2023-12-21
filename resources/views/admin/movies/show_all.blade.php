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
                        <li class="breadcrumb-item active" aria-current="page">{{$menu}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$menu}}</h3>
                <div class="col">

                    <div class="float-right">
                        <button class="btn btn-danger btn-sm d-none" id="deleteAllBtn" onClick="removeAll('/admin/categories/destroy-selected', 'categories-table')">
                            Xóa
                        </button>
                    </div>
                </div>

            </div>


            <div class="card-body p-0 table-responsive">

                <table class="table table-hover table-bordered table-striped" id="categories-table">
                    <thead>
                    <tr>
                        <th style="width:2%"><input type="checkbox" name="main_checkbox"><label></label></th>
                        <th style="width:8%">STT</th>
                        <th style="width:20%">Tên danh mục</th>
                        <th style="width:35%">Mô tả</th>
                        <th style="width:20%" class="text-center">Poster Phim</th>
                        <th style="width:10%" class="text-center">Sửa/Xóa</th>
                    </tr>
                    </thead>

                    <tbody>
                    {!! \App\Helpers\Helper::list($list) !!}
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

            <div class="card-footer clearfix" id="count">
                <?php $count = count($list); ?>
                <?php if($count === 0) : ?>
                <strong>Chưa có dữ liệu</strong>
                <?php else : ?>
                <strong>Số lượng: {{$count}}</strong>
                <?php endif; ?>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </section>
@endsection

