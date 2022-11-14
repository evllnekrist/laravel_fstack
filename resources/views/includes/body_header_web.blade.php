 <!--begin::Header-->
 <div id="kt_header" class="header header-fixed">
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                <h5 class="text-dark font-weight-bold my-1 mr-5 mt-7">@yield('header_title')</h5>
            </div>
        </div>
        <div class="topbar">
            <div class="topbar-item display-notif">
                <div class="btn btn-icon btn-clean btn-lg mr-1" id="kt_quick_panel_toggle">
                    <span class="svg-icon svg-icon-warning svg-icon-3x">
                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Notifications1.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <path d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z" fill="#000000"/>
                                <rect fill="#000000" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    @if(@$total_notif)
                        <a href="#" class="badge badge-danger" style="margin-top:30px;margin-right:-30px;position:absolute;">{{$total_notif}}</a>
                    @endif                
                </div>
            </div>
            <div class="dropdown">
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2">
                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Selamat datang, </span>
                        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">Petra</span>
                        <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                            <img class="symbol-label font-size-h5 font-weight-bold" src="{{ asset('assets/media/users/user2.jpg') }}" />
                        </span>
                    </div>
                </div>
                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                    <ul class="navi navi-hover py-4">
                        <li class="navi-item">
                            <a href="" class="navi-link">
                                <span class="navi-text">{{ __('Profil') }}</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <form method="POST" action="{{ url('/logout') }}">
                                @csrf
                                <a href="logout" class="navi-link"  href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <span class="navi-text">{{ __('Keluar') }}</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10">
        <!--begin::Header-->
        <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
            <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10" role="tablist">
                <li class="nav-item">
                    <a  class="nav-link text-warning" data-toggle="tab" 
                        href="#kt_quick_panel_notif_kemendikbud" id="kt_quick_panel_notif_kemendikbud_btn">Notifikasi</a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link" data-toggle="tab" 
                        href="#kt_quick_panel_status_recap" id="kt_quick_panel_status_recap_btn">Rekap Status</a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link" data-toggle="tab" 
                        href="#kt_quick_panel_notif_complaint" id="kt_quick_panel_notif_complaint_btn">Komplain</a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link" data-toggle="tab" 
                        href="#kt_quick_panel_notif_messaging" id="kt_quick_panel_notif_messaging_btn">Pesan</a>
                </li>
            </ul>
            <div class="offcanvas-close mt-n1 pr-5">
                <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
                    <i class="ki ki-close icon-xs text-muted"></i>
                </a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="offcanvas-content px-10">
            <div class="tab-content overlay overlay-block rounded" id="kt_quick_panel_notif_loading_container">
                <div class="overlay-layer rounded bg-primary-o-20" id="kt_quick_panel_notif_loading">
                    <div class="spinner spinner-primary"></div>
                </div>
                <!--begin::Tabpane-->
                <div class="tab-pane fade show pt-3 pr-5 mr-n5" id="kt_quick_panel_notif_kemendikbud" role="tabpanel">
                    <div class="mb-5">
                        <div id="quick_panel_notif_kemendikbud_items"></div>
                    </div>
                    <div class="mb-5">
                        <h4 class="text-muted mb-5" id="quick_panel_notif_kemendikbud_items_tindak_lanjut_title">Perlu Ditindaklanjuti</h4>
                        <div id="quick_panel_notif_kemendikbud_items_tindak_lanjut"></div>
                    </div>
                    <div class="mb-15">
                        <h4 class="text-muted mb-5" id="quick_panel_notif_kemendikbud_items_info_title">Informasi untuk Anda</h4>
                        <div id="quick_panel_notif_kemendikbud_items_info"></div>
                    </div>
                </div>
                <!--end::Tabpane-->
                <!--begin::Tabpane-->
                <div class="tab-pane fade show pt-3 pr-5 mr-n5" id="kt_quick_panel_status_recap" role="tabpanel">
                    <div class="mb-5">
                        <div id="quick_panel_order_items"></div>
                    </div>
                </div>
                <!--end::Tabpane-->
                <!--begin::Tabpane-->
                <div class="tab-pane fade pt-2 pr-5 mr-n5" id="kt_quick_panel_notif_complaint" role="tabpanel">
                    <div class="mb-15">
                        <h6 class="text-muted mb-5" id="quick_panel_notif_complaint_open_title" style="display:none">Pesan <u>komplain aktif</u> yang belum dibaca</h6>
                        <div id="quick_panel_notif_complaint_open_items"></div>
                    </div>
                    <div class="mb-15">
                        <h6 class="text-muted mb-5" id="quick_panel_notif_complaint_resolved_title" style="display:none">Pesan <u>komplain selesai</u> yang belum dibaca</h6>
                        <div id="quick_panel_notif_complaint_resolved_items"></div>
                    </div>
                </div>
                <!--end::Tabpane-->
                <!--begin::Tabpane-->
                <div class="tab-pane fade pt-3 pr-5 mr-n5" id="kt_quick_panel_notif_messaging" role="tabpanel">
                    <div class="mb-15">
                        <h6 class="text-muted mb-5" id="quick_panel_notif_messaging_transaction_title" style="display:none">Pesan <u>[TRANSAKSI]</u> yang belum dibaca</h6>
                        <div id="quick_panel_notif_messaging_transaction_items"></div>
                    </div>
                    <div class="mb-15">
                        <h6 class="text-muted mb-5" id="quick_panel_notif_messaging_customer_title" style="display:none">Pesan <u>[NON-TRANSAKSI]</u> yang belum dibaca</h6>
                        <div id="quick_panel_notif_messaging_customer_items"></div>
                    </div>
                </div>
                <!--end::Tabpane-->
            </div>
        </div>
        <!--end::Content-->
    </div>
</div>
<!--end::Header-->


