@extends('cms.layouts.app')
@section('css')
    <link href="{{url('backend/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{url('tavsiocms')}}" class="text-muted">Anasayfa</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{url('tavsiocms/logs')}}" class="text-muted">Log</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        <h3 class="card-label">Loglar
                            <div class="text-muted pt-2 font-size-sm">Sisteme Yeni Log Ekleme İşlemleri</div>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>Kullanıcı Adı</th>
                            <th>Log Tipi</th>
                            <th>Düzey</th>
                            <th>İçerik</th>
                            <th>Tarih</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>
@endsection
@section('js')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{url('backend/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <!--end::Page Scripts-->
    <script>
        "use strict";
        var KTDatatablesAdvancedColumnRendering = function() {

            var init = function() {
                var table = $('#kt_datatable');

                // begin first table
                table.DataTable({
                    responsive: true,
                    paging: true,
                    processing : true,
                    serverSide: true,
                    language: {
                        url : '/backend/tr.json'
                    },
                    ajax:{
                        type: 'POST',
                        url: '/tavsiocms/logs-ajax',
                    },
                    columns: [
                        {data: 'username', name: 'username'},
                        {data: 'display', name: 'display'},
                        {data: 'level', name: 'level'},
                        {data: 'content', name: 'content'},
                        {data: 'created_at', name: 'created_at'}
                    ],
                });
                $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
            };

            return {

                //main function to initiate the module
                init: function() {
                    init();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTDatatablesAdvancedColumnRendering.init();
        });

    </script>
@endsection
