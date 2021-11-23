@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('getHome') }}">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title p-2 text-bold">Products</h3>

                            <div class="card-tools">
                                <a href="{{ route('products.create') }}" class="btn btn-success">Add New Product</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        @include('includes.alert')
                        <div class="card-body table-responsive p-0" tyle="height: 500px;">
                            <table class="table table-head-fixed table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Created On</th>
                                        <th>View</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{ ($products->currentPage()-1)*$products->perPage()+$loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->categoryRelation->name }}</td>
                                        <td>{{ getFormatedDate($product->created_at) }}</td>
                                        <td><a href="{{ route('products.show',['product'=>$product->id]) }}" class="btn btn-primary">View</a></td>
                                        <td><a href="{{ route('products.edit',['product'=>$product->id]) }}" class="btn btn-warning text-white">Edit</a></td>
                                        <td>
                                            <form action="{{ route('products.destroy',['product'=>$product->id]) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <div class="mx-5 mt-3" style="float: right;">
                                {{ $products->onEachSide(5)->links() }}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



@endsection