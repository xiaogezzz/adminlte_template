@extends('adminlte::page')

@section('content_header')
    <h1>403 Error Page</h1>
@stop

@section('content')
    <!-- Main content -->
        <div class="error-page">
            <h2 class="headline text-danger"> 403</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-danger"></i> 访问被拒绝</h3>

                <p>
                    您没有操作此资源的权限！
                    请联系管理员。
                </p>

                <form class="search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" name="submit" class="btn btn-danger"><i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.input-group -->
                </form>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    <!-- /.content -->
@stop
