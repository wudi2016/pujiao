<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>创课在线普教版管理后台</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="keywords" content="启创教育云管理后台,启创,教育,教育云平台" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- basic styles -->

	<link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
	<link rel="stylesheet" href="{{asset('admin/assets/css/font-awesome.min.css')}}" />

	<!--[if IE 7]>
	<link rel="stylesheet" href="{{asset('admin/assets/css/font-awesome-ie7.min.css')}}" />
	<![endif]-->

	<!-- page specific plugin styles -->

	<!-- fonts -->

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

	<!-- ace styles -->

	<link rel="stylesheet" href="{{asset('admin/assets/css/ace.min.css')}}" />
	<link rel="stylesheet" href="{{asset('admin/assets/css/ace-rtl.min.css')}}" />

	<!--[if lte IE 8]>
	<link rel="stylesheet" href="{{asset('admin/assets/css/ace-ie.min.css')}}" />
	<![endif]-->

	<!-- inline styles related to this page -->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

	<!--[if lt IE 9]>
	<script src="{{asset('admin/assets/js/html5shiv.js')}}"></script>
	<script src="{{asset('admin/assets/js/respond.min.js')}}"></script>
	<![endif]-->
</head>

<body class="login-layout">
<div class="main-container">
	<div class="main-content">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="login-container">
					<div class="center">
						<h1>
							{{--<i class="icon-leaf green"></i>--}}
							{{--<span class="red"></span>--}}
							{{--<span class="white" style="font-size: 26px;">启创教育云平台后台管理系统</span>--}}
						</h1>
						<h4 class="blue">　</h4>
					</div>

					<div class="space-6"></div>

					<div class="position-relative">
						<div id="login-box" class="login-box visible widget-box no-border">
							<div class="widget-body">
								<div class="widget-main">
									<h4 class="header blue lighter bigger">
										<i class="icon-coffee green"></i>
										启创教育云管理后台
									</h4>

									<div class="space-6"></div>
									@if (count($errors) > 0)
										<div class="alert alert-danger">
											<ul>
												@foreach ($errors->all() as $error)
													<li>{{ $error }}</li>
												@endforeach
											</ul>
										</div>
									@endif

									<form action="login" method="post">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<fieldset>
											<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Username" name="username" value="{{old('username')}}" />
															<i class="icon-user"></i>
														</span>
											</label>

											<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password"  name="password" id="password" />
															<i class="icon-lock"></i>
														</span>
											</label>

											<div class="space"></div>

											<div class="clearfix">
												<label class="inline">
													<input type="checkbox" class="ace" name="remember" />
													<span class="lbl"> Remember Me</span>
												</label>

												<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
													<i class="icon-key"></i>
													Login
												</button>
											</div>

											<div class="space-4"></div>
											<input type="hidden" name="admin" value="true">
										</fieldset>
									</form>





					</div><!-- /position-relative -->
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->

{{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>--}}

<!-- <![endif]-->

<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

<!--[if !IE]> -->

<script type="text/javascript">
	window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
	window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

<script type="text/javascript">
	if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>

<!-- inline scripts related to this page -->

<script type="text/javascript">
	function show_box(id) {
		jQuery('.widget-box.visible').removeClass('visible');
		jQuery('#'+id).addClass('visible');
	}
</script>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>
