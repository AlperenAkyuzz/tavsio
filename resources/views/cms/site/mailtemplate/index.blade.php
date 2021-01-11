@extends('cms.layouts.app')
@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            @include('cms.layouts.breadcrumb')

            <div class="d-flex align-items-center">
                <a href="{{url('tavsiocms/site/mail-template/add')}}" class="btn btn-success btn-sm font-weight-bold mr-2">
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
                        <h3 class="card-label"> Mail Şablonları
                            <div class="text-muted pt-2 font-size-sm">Mail Şablonları</div>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-custom alert-notice alert-light-warning fade show" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Şablonları eklerken bazı kısa kodlar tanımlamanız gerekebilir.
                            <b>Örnek: {USERAD},{USERSOYAD},{LINK}</b>
                        </div>
                        <div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                            </button>
                        </div>
                    </div>

                    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>Tarih</th>
                                <th>Başlık</th>
                                <th>Tanımı (Kod)</th>
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
        var ozeldersUrl       = '/tavsiocms/site/mail-template/ajax';
        var ozeldersColumns   = [
            {data: 'created_at', name: 'created_at'},
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
            {data: 'actions', name: 'actions'}
        ];
    </script>
@endsection
