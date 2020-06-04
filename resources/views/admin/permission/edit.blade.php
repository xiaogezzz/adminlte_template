@extends('adminlte::page')

@section('content_header')
    <h1>编辑权限</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{ route('permissions.index') }}" type="button"
                           class="btn btn-block btn-light btn-sm text-dark"><i class="fas fa-chevron-left"></i> 返回
                        </a>
                    </h3>
                </div>
                <!-- /.card-header -->
                <form role="form" data-parsley-validate="true" name="edit-role"
                      action="{{ route('permissions.update', $permission->id) }}" method="post" id="edit">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                            <div class="form-group">
                                <label for="name">标识</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" id="name" name="name" value="{{ $permission->name }}"
                                           class="form-control" placeholder="请填写标识" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="display_name">名称</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="display_name" name="display_name"
                                           placeholder="请填写昵称" value="{{ $permission->display_name }}">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">描述信息</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <textarea name="description" id="description" cols="2"
                                              class="form-control">{{ $permission->description }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">更新</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->

        </div>
    </div>
@stop

@section('js')
    <script>
        ajaxSubmitData('edit');
    </script>
@stop
