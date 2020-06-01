@extends('adminlte::page')

@section('content_header')
    <h1>角色列表</h1>
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

                    <div class="float-right">
                        <form action="{{ route('roles.index') }}" method="GET">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right"
                                       placeholder="搜索" value="{{ $keywords }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th></th>
                            <th>标识</th>
                            <th>名称</th>
                            <th>描述信息</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($list))
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->display_name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        @if($item->name != 'Super Admin')
                                            <a href="{{ route('roles.edit', $item->id) }}"
                                               class="btn btn-outline-info btn-xs edit"><i class="fas fa-edit"></i>
                                                编辑</a>
                                            <a href="javascript:void(0);"
                                               data-href="{{ route('roles.destroy', $item->id) }}"
                                               class="btn btn-outline-danger btn-xs delete"><i class="fas fa-trash"></i>
                                                删除</a>
                                        @endif
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
                        <div class="float-left text-muted">共 {{ $list->total() }} 条记录</div>
                        <div class="float-right">
                            {!! $list->links() !!}
                        </div>
                    </div>
                @endif
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
            <form data-parsley-validate="true" name="create-admin"
                  action="{{ route('roles.store') }}" method="post" id="create">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">新增角色</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">标识</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="请填写标识"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="display_name">名称</label>
                            <input type="text" class="form-control" id="display_name" name="display_name"
                                   placeholder="请填写名称">
                        </div>
                        <div class="form-group">
                            <label for="description">描述</label>
                            <textarea class="form-control" name="description" id="description" rows="1"
                                      placeholder="请填写描述信息"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="permissions[]">权限</label>
                            <select class="duallistbox form-control" id="permissions[]" name="permissions[]"
                                    multiple="multiple">
                                @foreach($permissions as $permission)
                                    <option>{{ $permission->name }}</option>
                                @endforeach
                            </select>
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

@section('plugins.Bootstrap Duallistbox', true)

@section('js')
    <script>
        ajaxSubmitData('create');

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox({
            filterPlaceHolder: '筛选'
        })
    </script>
@stop
