@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>编辑角色</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{ route('roles.index') }}" type="button" class="btn btn-block btn-primary btn-sm"><i
                                class="fas fa-chevron-left"></i> 返回
                        </a>
                    </h3>
                </div>
                <!-- /.card-header -->
                <form role="form" data-parsley-validate="true" name="edit-role"
                      action="{{ route('roles.update', $role->id) }}" method="post" id="edit">
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
                                    <input type="text" id="name" name="name" value="{{ $role->name }}"
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
                                           placeholder="请填写昵称" value="{{ $role->display_name }}">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">描述信息</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <textarea name="description" id="description" cols="2"
                                              class="form-control">{{ $role->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="permissions[]">权限</label>
                                <select class="duallistbox form-control" id="permissions[]" name="permissions[]"
                                        multiple="multiple">
                                    @foreach($permissions as $permission)
                                        <option @if($role->hasPermissionTo($permission->name))
                                                selected @endif>{{ $permission->name }}</option>
                                    @endforeach
                                </select>
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

@section('plugins.Bootstrap Duallistbox', true)

@section('js')
    <script>
        ajaxSubmitData('edit');

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox({
            filterPlaceHolder: '筛选'
        })
    </script>
@stop
