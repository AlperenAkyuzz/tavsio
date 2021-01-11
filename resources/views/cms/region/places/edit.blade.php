@extends('cms.layouts.app')
@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            @include('cms.layouts.breadcrumb')
            <div class="d-flex align-items-center">
                <a href="{{url('tavsiocms/region/places')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3">
                    <i class="fas fa-hand-point-left"></i> Geri Dön
                </a>
                <a href="{{url('tavsiocms/region/places')}}" class="btn btn-light-danger font-weight-bolder btn-sm">
                    <i class="far fa-times-circle"></i> İptal Et
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <form class="form" action="{{url('tavsiocms/region/places/edit/'.$place->uuid)}}" method="post">
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
                            <label>Semt :</label>
                            <input type="text" name="place" class="form-control form-control-solid"
                                   placeholder="Semt" value="{{$place->place}}"/>
                            <span class="form-text text-muted">Lütfen semt alanını doldurunuz!</span>
                        </div>

                        <div class="form-group">
                            <label for="district_id">İlçe :</label>
                            <select class="form-control selectpicker" name="district_id" required>
                                <option disabled selected>Bir ilçe seçiniz.</option>
                                @foreach($districts as $district)
                                    <option value="{{$district->id}}" @if($district->id==$place->district_id){{"selected"}} @endif >{{$district->district}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Durumu :</label>
                            <div class="checkbox-list">
                                <label class="checkbox">
                                    <input type="checkbox" name="status" value="1" @if($place->status == 1) {{'checked'}} @endif/>
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
