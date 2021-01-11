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
                <form class="form" action="{{url('tavsiocms/home-management/home-background')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="card-body">
                        {{--Formdan hatali bir islem gelirse controller dosyasinda bahsettim buraya geliyor--}}
                        @if ($errors->any())
                            <div class="alert alert-custom alert-notice alert-light-danger fade show mb-5" role="alert"
                                 style="padding: 0.5rem 2rem;">
                                <div class="alert-icon">
                                    <i class="flaticon-warning"></i>
                                </div>
                                <div class="alert-text">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="ki ki-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="file" name="image" class="dropify" id="photo" accept="image/*" data-height="200" data-width="200" data-default-file="{{url('images/general/'.$site->home_background)}}" />
                        </div>
                        <button type="submit" class="btn btn-success mr-2 btn-sm font-weight-bolder">
                            <i class="fas fa-save"></i> Formu Kaydet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('cssFiles')
    <link rel="stylesheet" href="{{url('backend/dropify/css/dropify.css')}}" />
@endsection
@section('js')
    <!--begin::Page Vendors(used by this page)-->
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script src="{{asset('backend/dropify/js/dropify.min.js')}}" type="text/javascript"></script>
    <!--end::Page Vendors-->
    <script>
        var ozeldersDatatable = false;
        var dropify = true;
    </script>
@endsection
