@extends('cms.layouts.app')
@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            @include('cms.layouts.breadcrumb')

            <div class="d-flex align-items-center">
                <a href="{{url('tavsiocms/site/mail/add')}}" class="btn btn-success btn-sm font-weight-bold mr-2">
                    <i class="flaticon2-plus-1 icon-nm"></i> Yeni Ekle
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        <h3 class="card-label"> Kullanıcılara Mail ve Bildirim Gönder
                            <div class="text-muted pt-2 font-size-sm">Kullanıcılara Mail ve Bildirim Gönder</div>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Başlık</th>
                                <th>Mesaj</th>
                                <th>Gönderilenler</th>
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
        var ozeldersUrl       = '/tavsiocms/site/mail/ajax';
        var ozeldersColumns   = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'message', name: 'message'},
            {data: 'user', name: 'user'},
            {data: 'actions', name: 'actions'}
        ];
    </script>
@endsection
