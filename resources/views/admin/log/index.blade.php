@extends('adminlte::page')

@section('content_header')
    <h1>操作日志列表</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">&nbsp;</h3>

{{--                    <div class="float-right">--}}
{{--                        <form action="{{ route('logs.index') }}" method="GET">--}}
{{--                            <div class="input-group input-group-sm" style="width: 150px;">--}}
{{--                                <input type="text" name="search" class="form-control float-right"--}}
{{--                                       placeholder="搜索" value="{{ $keywords }}">--}}

{{--                                <div class="input-group-append">--}}
{{--                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle table-hover text-nowrap table-sm">
                        <thead class="bg-gray">
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Method</th>
                            <th>Path</th>
                            <th>Ip</th>
                            <th>Input</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($list))
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->admin->nickname ?? $item->admin->name }}</td>
                                    <td>{{ $item->method }}</td>
                                    <td><span class="badge bg-gray">{{ $item->path }}</span></td>
                                    <td><span class="badge bg-dark">{{ $item->ip }}</span></td>
                                    <td>@if(empty($item->input)) - @else
                                            <pre class="bg-gray">{{ $item->input }}</pre> @endif
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="javascript:void(0);"
                                           data-href="{{ route('logs.destroy', $item->id) }}"
                                           class="btn btn-warning btn-xs delete"><i class="fas fa-trash"></i>
                                            删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" align="center"><i class="fas fa-info-circle"></i>&nbsp;暂无符合条件的记录</td>
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

@stop
