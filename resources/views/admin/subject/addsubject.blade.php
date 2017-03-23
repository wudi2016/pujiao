@extends('layouts.layoutAdmin')
@section('content')



    <div class="main-content">
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try {
                    ace.settings.check('breadcrumbs', 'fixed')
                } catch (e) {
                }
            </script>

            <ul class="breadcrumb">
                <li>
                    <i class="icon-home home-icon"></i>
                    <a href="{{url('/admin/index')}}">首页</a>
                </li>

                <li>
                    <a href="{{url('/admin/subject/subjectList')}}">科目列表</a>
                </li>
                <li class="active">科目添加</li>
            </ul><!-- .breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    科目管理
                    <small>
                        <i class="icon-double-angle-right"></i>
                        科目添加
                    </small>
                </h1>
            </div><!-- /.page-header -->

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <form action="{{url('admin/subject/addssubject')}}" onsubmit="return checkThisOnly();" method="post" class="form-horizontal"
                          role="form"
                          enctype="multipart/form-data">
                        <div class="space-4"></div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 科目名称 </label>

                            <div class="col-sm-9">
                                <input type="text" id="subjectname" name="subjectname" placeholder="科目名称" class="col-xs-10 col-sm-5"
                                       value="{{old
                                ('subjectname')}}"/>
                                    <span class="help-inline col-xs-12 col-sm-7">

                                    <label class="middle">
                                        <span class="lbl"></span>
                                        <span class="kemu" style="position:relative;top:5px;font-size:10px;color:red"></span>
                                    </label>

                                </span>
                            </div>
                        </div>

                        <div class="space-4"></div>


                        {{--<div class="form-group">--}}
                        {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 状态 </label>--}}

                        {{--<div class="col-sm-9">--}}
                        {{--<select id="form-field-2" class="col-xs-10 col-sm-5" name="status">--}}
                        {{--<option value="0">激活</option>--}}
                        {{--<option value="1">锁定</option>--}}
                        {{--</select>--}}
                        {{--</div>--}}
                        {{--</div>--}}


                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" id="button1" type="submit">
                                    <i class="icon-ok bigger-110"></i>
                                    确定
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="icon-undo bigger-110"></i>
                                    重置
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    </form>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->


    </div><!-- /.main-content -->
@endsection

@section('js')
    {{--<script language="javascript" type="text/javascript" src="{{asset('DatePicker/WdatePicker.js') }}"></script>--}}
    {{--<script language="javascript" type="text/javascript" src="{{asset('admin/js/searchtype.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ URL::asset('/admin/js/addSubject.js') }}"></script>--}}

    <script>

        {{--function checkThisOnly() {--}}
            {{--var name = $('#subjectname').val();--}}
            {{--$.ajax({--}}
                {{--type: 'get',--}}
                {{--url: '{{url('admin/subject/name_unique')}}',--}}
                {{--dataType: 'json',--}}
                {{--data: {name: name},--}}
                {{--success: function (data) {--}}
                    {{--var str = '';--}}
                    {{--if (data.status == 1) {--}}
                        {{--str += '此科目已存在!';--}}
                        {{--$("#button1").attr("disabled", true);--}}
                        {{--$('.kemu').html(str);--}}
                        {{--return false;--}}
                    {{--} else {--}}
                        {{--$('.kemu').html(str);--}}
                        {{--return true;--}}
                    {{--}--}}

                {{--},--}}
                {{--error: function (xhr, type) {--}}

                {{--}--}}
            {{--});--}}
        {{--}--}}
    </script>



@endsection