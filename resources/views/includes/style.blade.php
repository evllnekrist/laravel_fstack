@section('header_title','Mie Pakcip')
<title>@yield('page_title', 'Laravel FStack')</title>
<meta charset="utf-8" />
<meta name="description" content="WebApp with FE restful API" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('includes.'.$layout_type.'_css')
@yield('page_css')
<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.png') }}" />