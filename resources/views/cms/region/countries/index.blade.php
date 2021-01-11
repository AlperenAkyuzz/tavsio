@extends('cms.layouts.app')
@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            @include('cms.layouts.breadcrumb')

            <div class="d-flex align-items-center">
                <a href="{{url('tavsiocms/region/countries/add')}}" class="btn btn-success btn-sm font-weight-bold mr-2">
                    <i class="flaticon2-plus-1 icon-nm"></i> Yeni Ülke Ekle
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        <h3 class="card-label"> Ülkeler
                            <div class="text-muted pt-2 font-size-sm">Sisteme Yeni Ülke Ekleme İşlemleri</div>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>Ülke</th>
                                <th>ISO</th>
                                <th>ISO3</th>
                                <th>Ülke Kodu</th>
                                <th>Para Birimi</th>
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
        var ozeldersUrl       = '/tavsiocms/region/countries';
        var ozeldersColumns   = [
            {data: 'printable_name', name: 'printable_name'},
            {data: 'iso', name: 'iso'},
            {data: 'iso3', name: 'iso3'},
            {data: 'numcode', name: 'numcode'},
            {data: 'currency', name: 'currency'},
            {data: 'status', name: 'status'},
            {data: 'actions', name: 'actions'}
        ];
    </script>
@endsection
