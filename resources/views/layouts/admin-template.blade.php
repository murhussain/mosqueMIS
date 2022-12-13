<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Church content management system">
	<meta name="keywords" content="church, content management system, cms">

	<title>{{config('app.name')}}</title>

	<link rel="stylesheet" href="{{ asset('css/font-awesome.css')}}">
	<link rel="stylesheet" href="{{ asset('css/animate.css')}}">
	<link rel="stylesheet" href="{{ asset('css/whirl.css')}}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}" id="bscss">
	<link rel="stylesheet" href="{{ asset('css/style.css')}}" id="maincss">

	@stack('styles')

	@if(config('app.env')=='production')
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

            ga('create', '{{config('google.analytics')}}', 'auto');
            ga('send', 'pageview');
		</script>
	@endif

	<script>
        let curPage = "{{request()->segment(1)}}";
        let CRSF_TOKEN = '{{csrf_token()}}';
	</script>

</head>

<body>
<div class="loading">Loading&#8230;</div>
<div class="wrapper">
	<header class="topnavbar-wrapper">
		<nav class="navbar topnavbar">
			<div class="navbar-header">
				<a class="navbar-brand" href="{{url('/')}}">
					<div class="brand-logo">
						<img class="img-fluid" src="{{ url('img/logo.png')}}" alt="App Logo">
					</div>
					<div class="brand-logo-collapsed">
						<img class="img-fluid" src="{{ url('img/logo-single.png')}}" alt="App Logo">
					</div>
				</a>
			</div>
			<ul class="navbar-nav mr-auto flex-row">
				<li class="nav-item">
					<a class="nav-link d-none d-md-block d-lg-block d-xl-block" href="#" data-trigger-resize=""
					   data-toggle-state="aside-collapsed">
						<em class="fa fa-navicon"></em>
					</a>
					<a class="nav-link sidebar-toggle d-md-none" href="#" data-toggle-state="aside-toggled"
					   data-no-persist="true">
						<em class="fa fa-navicon"></em>
					</a>
				</li>
				<li class="nav-item d-none d-md-block">
					<a class="nav-link" id="user-block-toggle" href="#user-block" data-toggle="collapse">
						<em class="fa fa-user"></em>
					</a>
				</li>
				<li class="nav-item d-none d-md-block">
					<a class="nav-link" href="{{route('logout')}}" title="Lock screen">
						<em class="fa fa-lock"></em>
					</a>
				</li>
			</ul>
			<ul class="navbar-nav flex-row">
				<li class="nav-item">
					<a class="nav-link" href="#" data-search-open="">
						<em class="fa fa-search"></em>
					</a>
				</li>
				<li class="nav-item d-none d-md-block">
					<a class="nav-link" href="#" data-toggle-fullscreen="true">
						<em class="fa fa-expand"></em>
					</a>
				</li>
				<li class="nav-item d-none d-md-block">
					<a class="nav-link" href="/support">
						<em class="fa fa-question-circle"></em>
					</a>
				</li>
				@if(has_role('admin'))
					<li class="nav-item">
						<a class="nav-link" href="#" data-toggle-state="offsidebar-open" data-no-persist="true">
							<em class="fa fa-cogs"></em>
						</a>
					</li>
				@endif
			</ul>
			<form class="navbar-form" role="search" action="{{URL()->to('search')}}">
				<div class="form-group">
					<input class="form-control" type="text" placeholder="Type and hit enter ...">
					<div class="fa fa-times navbar-form-close" data-search-dismiss=""></div>
				</div>
				<button class="d-none" type="submit">@lang('Submit')</button>
			</form>
		</nav>
	</header>
	<aside class="aside-container">
		<div class="aside-inner">
			<nav class="sidebar" data-sidebar-anyclick-close="">
				<ul class="sidebar-nav">
					<li class="has-user-block">
						<div class="" id="user-block">
							<div class="item user-block">
								<div class="user-block-picture">
									<div class="user-block-status">
										<img class="img-thumbnail rounded-circle"
											 src="/img/content/02.jpg" alt="Avatar" width="60" height="60">
										<div class="circle bg-success circle-lg"></div>
									</div>
								</div>
								<div class="user-block-info">
									<span class="user-block-name">
										@lang("Welcome")
										{{auth()->user()->first_name}}
									</span>
									<span class="user-block-role">
										<a href="/profile"><i class="fa fa-user"></i>
											@lang("My Profile")
										</a>
									</span>
								</div>
							</div>
						</div>
					</li>
					<li class=" "><a href="/dashboard" title="Dashboard v1"><em class="fa fa-dashboard"></em>
							<span data-localize="sidebar.nav.DASHBOARD">@lang('Dashboard')</span></a>
					</li>
					<li><a href="/account"><em class="fa fa-user"></em>
							<span>@lang("My Account")</span></a>
					</li>

					@if(has_role('admin'))

						<li><a href="/giving/gifts"><em class="fa fa-money"></em>
								<span>@lang("Gifts")</span></a></li>

						<li><a href="/messaging/admin">
								<div class="float-right badge badge-success">

								</div>
								<em class="fa fa-envelope"></em><span>@lang("Messaging")</span></a></li>

						<li><a href="/ministries/admin"><em class="fa fa-list"></em>
								<span>@lang("Ministries")</span></a></li>

						<li><a href="/sermons/admin"><em class="fa fa-th"></em>
								<span>@lang("Sermons")</span></a></li>

						<li><a href="/events/admin"><em class="fa fa-calendar"></em>
								<span>@lang("Events")</span></a></li>

						<li><a href="/blog/admin"><em class="fa fa-leaf"></em> <span>@lang("Blog")</span></a></li>

						<li>
							<a href="/users">
								<em class="fa fa-user"></em>
								<div class="float-right badge badge-success">{{\App\User::count()}}</div>
								<span>@lang("Users")</span>
							</a>
						</li>

						<li class="">
							<a href="#settings" title="Pages" data-toggle="collapse">
								<em class="fa fa-cogs"></em>
								<span data-localize="sidebar.nav.pages.PAGES">@lang('Admin')</span>
							</a>
							<ul class="sidebar-nav sidebar-subnav collapse" id="settings">
								<li class="sidebar-subnav-header">@lang('Admin')</li>
								<li><a href="/settings"><em class="fa fa-wrench"></em> @lang('Settings')</a></li>
								<li><a href="/roles"><em class="fa fa-key"></em> @lang('Roles')</a></li>
								<li><a href="/menu"><em class="fa fa-list-alt"></em> <span>@lang("Menu")</span></a></li>
								<li><a href="/theme"><em class="fa fa-th-list"></em> <span>@lang('Change themes')</span></a>
								</li>
								<li><a href="/giving/gift-options"><em class="fa fa-money"></em>
										<span>@lang("Gift Options")</span></a></li>
								<li><a href="/debug-log"><em class="fa fa-bug"></em>
										<span>@lang("Debug logs")</span></a></li>
							</ul>
						</li>

					@endif

					<li class="nav-item kiosk">
						<a class="nav-link" href="/kiosk">
							<em class="fa fa-external-link text-success"></em>
							<span class="text text-success">@lang("Kiosk")</span>
						</a>
					</li>
					<li class="nav-item kiosk">
						<a class="nav-link" href="{{url('logout')}}">
							<em class="fa fa-power-off text-danger"></em>
							<span class="text text-danger">@lang("Logout")</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</aside>
	<aside class="offsidebar d-none">
		<nav>
			<div role="tabpanel">
				@include('admin.drawer')
			</div>
		</nav>
	</aside>
	<section class="section-container">
		<div class="content-wrapper">
			<div class="content-heading">
				@hasSection('title') <h1>@yield('title')</h1> @endif
			</div>
			@yield('content')

		</div>
	</section>
	<footer class="footer-container">
		<span>&copy;{{date('Y').' '.config('app.name')}} - <a
					href="https://amdtllc.com">A&M Digital Technologies</a></span>
	</footer>
</div>
<script src="{{ asset('js/jquery.js')}}"></script>
<script src="{{ asset('plugins/modernizr.custom.js')}}"></script>
<script src="{{ asset('plugins/popper.js')}}"></script>
<script src="{{ asset('js/bootstrap.js')}}"></script>
<script src="{{ asset('plugins/js.storage.js')}}"></script>
<script src="{{ asset('plugins/jquery.easing.min.js')}}"></script>
<script src="{{ asset('plugins/animo.js')}}"></script>
<script src="{{ asset('plugins/screenfull.js')}}"></script>
<script src="{{ asset('js/tools.js')}}"></script>
{{--<script src="/js/global.js"></script>--}}
@include('partials.flash')
@stack('scripts')
@stack('modals')
</body>

</html>
