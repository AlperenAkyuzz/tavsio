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
                        <a href="{{url('tavsiocms/users')}}" class="text-muted">Kullanıcılar</a>
                    </li>
                </ul>
            </div>
            <!--end::Info-->
            <div class="d-flex align-items-center">
                <a href="#" class="btn btn-success btn-sm font-weight-bold mr-2">
                    <i class="flaticon2-plus-1 icon-nm"></i> Yeni Kullanıcı Ekle
                </a>
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
                        <h3 class="card-label">Kullanıcılar
                            <div class="text-muted pt-2 font-size-sm">Sisteme Yeni Kullanıcı Ekleme İşlemleri</div>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>Kullanıcı</th>
                            <th>E-posta</th>
                            <th>Kullanıcı İsim</th>
                            <th>Durum</th>
                            <th>İşlemler</th>
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
                    dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                    buttons: [
                        'print',
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5',
                    ],
                    ajax:{
                        type: 'POST',
                        url: '/tavsiocms/users-ajax',
                    },
                    columns: [
                        {data: 'name', name: 'email'},
                        {data: 'email', name: 'email'},
                        {data: 'username', name: 'username'},
                        {data: 'status', name: 'status'},
                        {data: 'actions', name: 'actions', orderable: false, searchable: false}
                    ],

                    /*columnDefs: [

                        {
                            targets: -1,
                            title: 'Actions',
                            orderable: false,
                            render: function(data, type, full, meta) {
                                return '\
							<div class="dropdown dropdown-inline">\
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">\
	                                <i class="la la-cog"></i>\
	                            </a>\
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
									<ul class="nav nav-hoverable flex-column">\
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>\
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-leaf"></i><span class="nav-text">Update Status</span></a></li>\
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-print"></i><span class="nav-text">Print</span></a></li>\
									</ul>\
							  	</div>\
							</div>\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">\
								<i class="la la-trash"></i>\
							</a>\
						';
                            },
                        },
                        {
                            targets: 4,
                            render: function(data, type, full, meta) {
                                var status = {
                                    1: {'title': 'Pending', 'class': 'label-light-primary'},
                                    2: {'title': 'Delivered', 'class': ' label-light-danger'},
                                    3: {'title': 'Canceled', 'class': ' label-light-primary'},
                                    4: {'title': 'Success', 'class': ' label-light-success'},
                                    5: {'title': 'Info', 'class': ' label-light-info'},
                                    6: {'title': 'Danger', 'class': ' label-light-danger'},
                                    7: {'title': 'Warning', 'class': ' label-light-warning'},
                                };
                                if (typeof status[data] === 'undefined') {
                                    return data;
                                }
                                return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                            },
                        },
                        {
                            targets: 5,
                            render: function(data, type, full, meta) {
                                var status = {
                                    1: {'title': 'Online', 'state': 'danger'},
                                    2: {'title': 'Retail', 'state': 'primary'},
                                    3: {'title': 'Direct', 'state': 'success'},
                                };
                                if (typeof status[data] === 'undefined') {
                                    return data;
                                }
                                return '<span class="label label-' + status[data].state + ' label-dot mr-2"></span>' +
                                    '<span class="font-weight-bold text-' + status[data].state + '">' + status[data].title + '</span>';
                            },
                        },
                    ],*/
                });

                /*$('#kt_datatable_search_status').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'Status');
                });

                $('#kt_datatable_search_type').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'Type');
                });*/

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
