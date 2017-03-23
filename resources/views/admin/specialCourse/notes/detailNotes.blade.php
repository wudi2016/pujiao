@extends('layouts.layoutAdmin')
@section('content')




    <div class="main-content">
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>

            <ul class="breadcrumb">
                <li>
                    <i class="icon-home home-icon"></i>
                    <a href="{{url('/admin/index')}}">首页</a>
                </li>

                <li>
                    <a href="{{url('/admin/specialCourse/specialCourseList')}}">创课课程</a>
                </li>
                <li class="active">课程笔记详情</li>
            </ul><!-- .breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    创课课程
                    <small>
                        <i class="icon-double-angle-right"></i>
                        课程笔记详情
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

                    <form  method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                        <div class="space-4"></div>

                        <input type="hidden" name="id"  value="{{$data->id}}"  >



                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> id </label>

                            <div class="col-sm-9">
                                <input  disabled="true" type="text" name="id" id="form-field-1" placeholder="id" class="col-xs-10 col-sm-5" value="{{$data->id}}" />
                                    <span class="help-inline col-xs-12 col-sm-7">
                                    <label class="middle">
                                        <span class="lbl"></span>
                                    </label>
                                </span>
                            </div>
                        </div>

                        <div class="space-4"></div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 评论内容 </label>

                            <div class="col-sm-9">
                                <textarea name="notecontent" id="form-field-2" class="col-xs-10 col-sm-5" cols="30" rows="10" style="resize:none;">{{$data->notecontent}}</textarea>
                            <span class="help-inline col-xs-12 col-sm-7">
                                <label class="middle">
                                    <span class="lbl"></span>
                                </label>
                            </span>
                            </div>
                        </div>
                        <div class="space-4"></div>


                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-4">
                                <a href="{{$_SERVER['HTTP_REFERER']}}" class="btn btn-info btn-block" style="margin-left: -15px;">
                                    <i class="icon-ok bigger-110"></i>
                                    返回上一页
                                </a>
                            </div>
                        </div>


                    </form>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->




    </div><!-- /.main-content -->
@endsection

@section('js')
    <script language="javascript" type="text/javascript" src="{{asset('DatePicker/WdatePicker.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{asset('admin/js/searchtype.js') }}"></script>



@endsection