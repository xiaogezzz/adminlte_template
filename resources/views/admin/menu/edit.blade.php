@extends('adminlte::page')

@section('content_header')
    <h1>编辑菜单</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{ route('menus.index') }}" type="button"
                           class="btn btn-block btn-light btn-sm text-dark"><i class="fas fa-chevron-left"></i> 返回
                        </a>
                    </h3>
                </div>
                <!-- /.card-header -->
                <form role="form" data-parsley-validate="true" name="edit-role"
                      action="{{ route('menus.update', $menu->id) }}" method="post" id="edit">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                            <div class="form-group">
                                <label for="parent_id">父级菜单</label>
                                <select class="select2 select2-hidden-accessible form-control" id="parent_id"
                                        name="parent_id" required style="width: 100%;">
                                    @foreach($options as $k => $option)
                                        <option value="{{ $k }}" @if($k == $menu->parent_id) selected @endif>{!! $option !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">标题</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" id="title" name="title" value="{{ $menu->title }}"
                                           class="form-control" placeholder="请填写标题" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="icon">图标</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="icon" name="icon"
                                           placeholder="请填写 icon" value="{{ $menu->icon }}">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="permission">权限</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-fingerprint"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="permission" name="permission"
                                           placeholder="请填写 icon" value="{{ $menu->permission }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="uri">uri</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="uri" name="uri"
                                           placeholder="请填写 icon" value="{{ $menu->uri }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="order">排序</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-sort-amount-up-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="order" name="order"
                                           placeholder="0" value="{{ $menu->order }}">
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

        $('.select2').select2()
    </script>
@stop
