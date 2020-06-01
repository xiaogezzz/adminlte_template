@extends('adminlte::page')

@section('content_header')
    <h1>编辑管理员</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{ route('admins.index') }}" type="button" class="btn btn-block btn-primary btn-sm"><i
                                class="fas fa-chevron-left"></i> 返回
                        </a>
                    </h3>
                </div>
                <!-- /.card-header -->
                <form role="form" data-parsley-validate="true" name="edit-admin"
                      action="{{ route('admins.update', $admin->id) }}" method="post" id="edit">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                            <div class="form-group">
                                <label for="name">用户名</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" id="name" name="name" value="{{ $admin->name }}"
                                           class="form-control" placeholder="请填写用户名" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nickname">昵称</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="nickname" name="nickname"
                                           placeholder="请填写昵称" required
                                           value="{{ $admin->nickname }}">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">密码</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-eye-slash"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="如不修改可以不填此项" minlength="6">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="roles">角色</label>
                                <select class="select2 form-control" multiple="multiple" id="roles" name="roles[]"
                                        data-placeholder="请选择角色" style="width: 100%;" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}"
                                                @if($admin->hasRole($role->name))selected @endif>{{ $role->display_name ?? $role->name }}</option>
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

@section('js')
    <script>
        $('.select2').select2()

        ajaxSubmitData('edit');

    </script>
@stop
