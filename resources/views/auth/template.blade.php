<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Church content management system">
	<meta name="keywords" content="church, content management system, cms">
	<title>{{config('app.name')}}</title>
	<link rel="stylesheet" href="{{ url('css/font-awesome.css')}}">
	<link rel="stylesheet" href="{{ url('css/animate.css')}}">
	<link rel="stylesheet" href="{{ url('css/whirl.css')}}">
	<link rel="stylesheet" href="{{ url('css/bootstrap.css')}}" id="bscss">
	<link rel="stylesheet" href="{{ url('css/style.css')}}" id="maincss">

	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	<script type="text/javascript">
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', '{{config('app.google-analytics')}}', 'auto');
        ga('send', 'pageview');
	</script>
</head>

<body>
<div class="wrapper">
	<div class="block-center mt-4 wd-xl">
		<!-- START card-->
		<div class="card card-flat">
			<div class="card-header text-center bg-dark">
				<a href="#">
					<img style="height:60px" class="block-center rounded" src="/img/logo.png" alt="Image">
				</a>
			</div>
			<div class="card-body">
				@yield('content')
			</div>
		</div>
		<!-- END card-->
		<div class="p-3 text-center">
			<span class="mr-2">&copy;</span>
			<span>{{date('Y')}}</span>
			<span class="mr-2">-</span>
			<span><a href="https://amdtllc.com">A&M Digital Tech</a> </span>
		</div>
	</div>
</div>

<script src="{{ url('js/jquery.js')}}"></script>
<script src="{{ url('plugins/modernizr.custom.js')}}"></script>
<script src="{{ url('plugins/popper.js')}}"></script>
<script src="{{ url('plugins/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ url('plugins/js.storage.js')}}"></script>
<script src="{{ url('plugins/jquery.easing.min.js')}}"></script>
<script src="{{ url('plugins/parsley.min.js')}}"></script>
<script src="{{ url('plugins/animo.js')}}"></script>
<script src="{{ url('plugins//screenfull.js')}}"></script>
<script src="{{ url('js/tools.js')}}"></script>
<script>
    $(document).ready(function () {

        var login = $('#loginform');
        var recover = $('#recoverform');
        var register = $('#registerform');

        var speed = 400;

        $('.to-recover').click(function () {

            $("#loginform").slideUp();
            $("#registerform").hide();
            $("#recoverform").fadeIn();

        });
        $('.to-login').click(function () {

            $("#recoverform").hide();
            $("#registerform").hide();
            $("#loginform").fadeIn();
        });
        $('.to-register').click(function () {
            $("#recoverform").hide();
            $("#loginform").hide();
            $("#registerform").fadeIn();
        });
    });
</script>
@include('partials.flash')
@stack('scripts')
@stack('modals')
</body>

</html>
