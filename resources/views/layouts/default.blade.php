<!DOCTYPE html>
<?php 
    $layout_type = "default";
?>
<html>
    <head>
        @include('includes.style')
    </head>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        @include('includes.body_header_mobile')
        <div class="d-flex flex-column flex-root">
            <div class="d-flex flex-row flex-column-fluid page">
                @include('includes.sidebar')
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    @include('includes.body_header_web')
                    @yield('content')
                    @include('includes.footer')
                </div>
            </div>
        </div>
        @include('includes.script')
    </body>
</html>