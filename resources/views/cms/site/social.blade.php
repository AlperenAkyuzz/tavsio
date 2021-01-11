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
                        <h3 class="card-label">Sosyal Medya Hesapları
                            <div class="text-muted pt-2 font-size-sm">Sosyal Medya Hesapları</div>
                        </h3>
                    </div>
                </div>
                <form class="form" action="{{url('tavsiocms/site/social/edit')}}" method="post">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Facebook :</label>
                                <input type="text" name="facebook" class="form-control" value="{{$social->facebook}}"/>
                            </div>
                            <div class="col-lg-6">
                                <label>Twitter :</label>
                                <input type="text" name="twitter" class="form-control" value="{{$social->twitter}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Instagram :</label>
                                <input type="text" name="instagram" class="form-control"
                                       value="{{$social->instagram}}"/>
                            </div>
                            <div class="col-lg-6">
                                <label>Linkedin :</label>
                                <input type="text" name="linkedin" class="form-control" value="{{$social->linkedin}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Youtube :</label>
                                <input type="text" name="youtube" class="form-control" value="{{$social->youtube}}"/>
                            </div>
                            <div class="col-lg-6">
                                <label>Periscope :</label>
                                <input type="text" name="periscope" class="form-control" value="{{$social->periscope}}"/>
                            </div>
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
.form-control {
    font-size: x-small !important;
}
    </style>
@endsection
