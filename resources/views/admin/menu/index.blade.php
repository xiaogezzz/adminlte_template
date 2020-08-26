@extends('adminlte::page')

@section('content_header')
    <h1>菜单列表</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">
                        <button type="button" class="btn btn-block btn-light btn-sm" data-toggle="modal"
                                data-target="#modal-default"><i class="fa fa-plus"></i> 新增
                        </button>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle table-hover text-nowrap">
                        <thead class="bg-gray">
                        <tr>
                            <th></th>
                            <th>菜单名称</th>
                            <th>图标</th>
                            <th>uri</th>
                            <th>权限</th>
                            <th>父级菜单</th>
                            <th>排序</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($list))
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td><i class="{{ $item->icon }}"></i>
                                    </td>
                                    <td>{{ $item->uri }}</td>
                                    <td>{{ $item->permission }}</td>
                                    <td>{{ $item->parent->title ?? 'ROOT' }}</td>
                                    <td>{{ $item->order }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ route('menus.edit', $item->id) }}"
                                           class="btn btn-outline-dark btn-xs edit"><i class="fas fa-edit"></i> 编辑</a>
                                        <a href="javascript:void(0);"
                                           data-href="{{ route('menus.destroy', $item->id) }}"
                                           class="btn btn-warning btn-xs delete"><i class="fas fa-trash"></i>
                                            删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" align="center"><i class="fas fa-info-circle"></i>&nbsp;暂无符合条件的记录</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                @if(count($list))
                    <div class="card-footer clearfix">
                        <div class="float-left text-muted">共 {{ $list->count() }} 条记录</div>
                    </div>
                @endif
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <form data-parsley-validate="true" name="create-admin"
                  action="{{ route('menus.store') }}" method="post" id="create">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h4 class="modal-title">新增菜单</h4>
                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="parent_id">父级菜单</label>
                            <select class="select2 select2-hidden-accessible form-control" id="parent_id"
                                    name="parent_id" required style="width: 100%;">
                                @foreach($options as $k => $option)
                                    <option value="{{ $k }}">{!! $option !!}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">标题</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="请填写标题"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="icon">图标</label>
                            <input type="text" class="form-control" id="icon" name="icon" value="far fa-circle"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="permission">权限</label>
                            <input type="text" class="form-control" id="permission" name="permission" placeholder="请填写权限">
                        </div>

                        <div class="form-group">
                            <label for="uri">uri</label>
                            <input type="text" class="form-control" id="uri" name="uri" placeholder="请填写 uri">
                        </div>

                        <div class="form-group">
                            <label for="order">排序</label>
                            <input type="text" class="form-control" id="order" name="order" placeholder="0">
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
        ajaxSubmitData('create');

        $('.select2').select2()
    </script>
@stop
