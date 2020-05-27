@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>管理员列表</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-gray">
                <div class="card-header">
                    <h3 class="card-title">
                        <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal"
                                data-target="#modal-default"><i class="fa fa-plus"></i> 新增
                        </button>
                    </h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right"
                                   placeholder="搜索">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th></th>
                            <th>用户名</th>
                            <th>昵称</th>
                            <th>角色</th>
                            <th>注册时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($list))
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->nickname }}</td>
                                    <td>
                                        @foreach($item->roles as $role)
                                            <span
                                                class="badge bg-primary">{{ $role->display_name ?? $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admins.edit', $item->id) }}"
                                           class="btn btn-outline-info btn-xs edit"><i class="fas fa-edit"></i> 编辑</a>
                                        @role('Super Admin')
                                            <a href="javascript:void(0);"
                                               data-href="{{ route('admins.destroy', $item->id) }}"
                                               class="btn btn-outline-danger btn-xs delete"><i class="fas fa-trash"></i>
                                                删除</a>
                                        @endrole
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" align="center"><i class="fas fa-info-circle"></i>&nbsp;暂无符合条件的记录</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                @if(count($list))
                    <div class="card-footer clearfix">
                        <div class="pull-left text-muted">共 {{ $list->total() }} 条记录</div>
                        <div class="pull-right">
                            {!! $list->links() !!}
                        </div>
                    </div>
                @endif
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <form class="form-horizontal" data-parsley-validate="true" name="create-admin"
                  action="{{ route('admins.store') }}" method="post" id="create">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">新增管理员</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">用户名</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="请填写用户名"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nickname" class="col-sm-2 col-form-label">昵称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nickname" name="nickname"
                                       placeholder="请填写昵称" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="请填写密码" required minlength="6">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="roles" class="col-sm-2 col-form-label">角色</label>
                            <div class="col-sm-10">
                                <select class="select2 form-control" multiple="multiple" id="roles" name="roles[]"
                                        data-placeholder="请选择角色" style="width: 100%;" required>
                                    @foreach($roles as $role)
                                        <option
                                            value="{{ $role->name }}">{{ $role->display_name ?? $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">确定</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </form>
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop

@section('js')
    <script>
        $('.select2').select2()

        ajaxSubmitData('create');
    </script>
@stop
