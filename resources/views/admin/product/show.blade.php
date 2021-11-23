@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('getHome') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">View Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-5">Name</div>
                        <div class="col-1">:</div>
                        <div class="col-6">{{ $product->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5">Category</div>
                        <div class="col-1">:</div>
                        <div class="col-6">{{ $product->categoryRelation->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5">Created On</div>
                        <div class="col-1">:</div>
                        <div class="col-6">{{ getFormatedDate($product->created_at) }}</div>
                    </div>
                    <div class="row">
                        <div class="col-5">Updated On</div>
                        <div class="col-1">:</div>
                        <div class="col-6">{{ getFormatedDate($product->updated_at) }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    @if($product->image != NULL)
                        <img src="{{ asset('storage//'.$product->image) }}" width="300px" height="300px">
                    @endif
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>


@endsection

