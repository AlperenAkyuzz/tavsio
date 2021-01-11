@extends('cms.layouts.app')
@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            @include('cms.layouts.breadcrumb')
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        <h3 class="card-label">İletişim Bilgileri Ayarları
                            <div class="text-muted pt-2 font-size-sm">İletişim Bilgileri Ayarları</div>
                        </h3>
                    </div>
                </div>
                <form class="form" action="{{url('tavsiocms/site/contact/edit')}}" method="post">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>E-posta Adresi :</label>
                                <input type="text" name="email" class="form-control" value="{{$contact->email}}"/>
                            </div>
                            <div class="col-lg-6">
                                <label>Telefon :</label>
                                <input type="text" name="phone" class="form-control" value="{{$contact->phone}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Telefon (Diğer) :</label>
                                <input type="text" name="phone_other" class="form-control"
                                       value="{{$contact->phone_other}}"/>
                            </div>
                            <div class="col-lg-6">
                                <label>Fax :</label>
                                <input type="text" name="fax" class="form-control" value="{{$contact->fax}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Şirket Adı :</label>
                                <input type="text" name="firm" class="form-control" value="{{$contact->firm}}"/>
                            </div>
                            <div class="col-lg-6">
                                <label>Marka Adı :</label>
                                <input type="text" name="brand" class="form-control" value="{{$contact->brand}}"/>
                            </div>
                        </div>
                        <div class="form-group mt-1 mb-1">
                            <label for="exampleTextarea">Adres :</label>
                            <textarea class="form-control" id="address" name="address"
                                      rows="3">{{$contact->address}}</textarea>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-success mr-2 btn-sm font-weight-bolder">
                                        <i class="fas fa-save"></i> Formu Kaydet ve Kapat
                                    </button>
                                    <a href="{{url('tavsiocms/')}}"
                                       class="btn btn-light-danger font-weight-bolder btn-sm">
                                        <i class="far fa-times-circle"></i> İptal Et
                                    </a>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        var ozeldersDatatable = false;
    </script>
@endsection
@section('cssFiles')
    <style>

    </style>
@endsection
