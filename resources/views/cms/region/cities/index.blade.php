@extends('cms.layouts.app')
@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            @include('cms.layouts.breadcrumb')

            <div class="d-flex align-items-center">
                <a href="{{url('tavsiocms/region/cities/add')}}" class="btn btn-success btn-sm font-weight-bold mr-2">
                    <i class="flaticon2-plus-1 icon-nm"></i> Yeni Şehir Ekle
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        <h3 class="card-label"> Şehirler
                            <div class="text-muted pt-2 font-size-sm">Sisteme Yeni Şehir Ekleme İşlemleri</div>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>Tarih</th>
                                <th>Şehir</th>
                                <th>Ülke</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        var ozeldersDatatable = true;
        var ozeldersUrl       = '/tavsiocms/region/cities';
        var ozeldersColumns   = [
            {data: 'created_at', name: 'created_at'},
            {data: 'city', name: 'city'},
            {data: 'printable_name', name: 'printable_name'},
            {data: 'status', name: 'status'},
            {data: 'actions', name: 'actions'}
        ];
    </script>
@endsection
