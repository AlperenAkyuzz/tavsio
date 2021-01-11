@extends('cms.layouts.app')
@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            @include('cms.layouts.breadcrumb')
            <div class="d-flex align-items-center">
                <a href="{{url('tavsiocms/region/countries')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3">
                    <i class="fas fa-hand-point-left"></i> Geri Dön
                </a>
                <a href="{{url('tavsiocms/region/countries')}}" class="btn btn-light-danger font-weight-bolder btn-sm">
                    <i class="far fa-times-circle"></i> İptal Et
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <form class="form" action="{{url('tavsiocms/region/countries/edit/'.$country->uuid)}}" method="post">
                    {{csrf_field()}}
                    <div class="card-body">
                        {{--Formdan hatali bir islem gelirse controller dosyasinda bahsettim buraya geliyor--}}
                        @if ($errors->any())
                            <div class="alert alert-custom alert-notice alert-light-danger fade show mb-5" role="alert" style="padding: 0.5rem 2rem;">
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
                            <label>Ülke :</label>
                            <input type="text" name="name" class="form-control form-control-solid"
                                   placeholder="Ülke" value="{{$country->name}}"/>
                            <span class="form-text text-muted">Lütfen ülke alanını doldurunuz!</span>
                        </div>
                        <div class="form-group">
                            <label>Ülke kodu :</label>
                            <input type="text" name="numcode" class="form-control form-control-solid"
                                   placeholder="Ülke kodu" value="{{$country->numcode}}"/>
                            <span class="form-text text-muted">Lütfen ülke kodu alanını doldurunuz!</span>
                        </div>
                        <div class="form-group">
                            <label>ISO :</label>
                            <input type="text" name="iso" class="form-control form-control-solid"
                                   placeholder="ISO" value="{{$country->iso}}"/>
                            <span class="form-text text-muted">Lütfen ISO alanını doldurunuz!</span>
                        </div>
                        <div class="form-group">
                            <label>ISO3 :</label>
                            <input type="text" name="iso3" class="form-control form-control-solid"
                                   placeholder="ISO3" value="{{$country->iso3}}"/>
                            <span class="form-text text-muted">Lütfen ISO3 alanını doldurunuz!</span>
                        </div>
                        <div class="form-group">
                            <label>Para Birimi :</label>
                            <input type="text" name="currency" class="form-control form-control-solid"
                                   placeholder="Para birimi" value="{{$country->currency}}"/>
                            <span class="form-text text-muted">Lütfen para birimi alanını doldurunuz!</span>
                        </div>
                        <div class="form-group">
                            <label>Durumu :</label>
                            <div class="checkbox-list">
                                <label class="checkbox">
                                    <input type="checkbox" name="status" value="1" @if($country->status == 1) {{'checked'}} @endif/>
                                    <span></span>
                                    Aktif
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success mr-2 btn-sm font-weight-bolder">
                          <i class="fas fa-save"></i>  Formu Kaydet ve Kapat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
