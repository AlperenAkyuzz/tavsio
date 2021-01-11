@extends('cms.layouts.app')
@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            @include('cms.layouts.breadcrumb')
            <div class="d-flex align-items-center">
                <a href="{{url('tavsiocms/site/mail')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3">
                    <i class="fas fa-hand-point-left"></i> Geri Dön
                </a>
                <a href="{{url('tavsiocms/site/mail')}}" class="btn btn-light-danger font-weight-bolder btn-sm">
                    <i class="far fa-times-circle"></i> İptal Et
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <form class="form" action="{{url('tavsiocms/site/mail/edit/'.$mail->uuid)}}" method="post">
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
                        <div class="form-group row">
                            <div class="col-lg-8">
                                <label>Başlık :</label>
                                <input type="text" id="title" name="title" class="form-control" placeholder="Başlık" value="{{$mail->title}}"/>
                                <span class="form-text text-muted">Lütfen başlık alanını doldurunuz!</span>
                            </div>
                            <div class="col-lg-4">
                                <label>Gönderilecek kullanıcılar :</label>
                                <select class="form-control selectpicker" name="usertype" required value="{{$mail->usertype}}">
                                    <option disabled selected>Kullanıcıları seçiniz.</option>
                                    @foreach($usertypes as $usertype)
                                        <option value="{{$usertype->id}}" @if($usertype->id==$mail->usertype){{"selected"}} @endif>{{$usertype->name}}</option>
                                    @endforeach
                                </select>
                                <span class="form-text text-muted">Lütfen gönderilecek kullanıcıları seçiniz!</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Mesaj :</label>
                            <textarea name="message" id="message" class="message">{{$mail->message}}</textarea>
                            <span class="form-text text-muted">Lütfen mesaj içeriğini doldurunuz!</span>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" name="notification" id="notification" value="1" @if($mail->notification == 1) {{'checked'}} @endif/>
                                    <span></span>
                                    Bildirim gönder.
                                </label>
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" name="email" id="email" value="1" @if($mail->email == 1) {{'checked'}} @endif/>
                                    <span></span>
                                    E-mail gönder.
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
@section('js')
    <!--begin::Page Vendors(used by this page)-->
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <!--end::Page Vendors-->
    <script type="text/javascript">
        $('.select2').select2();
        CKEDITOR.replace('message', {
            height: '400px',
            extraPlugins: 'forms',
            customConfig: '{{asset('backend/ckeditor/custom.js')}}'
        });
    </script>
@endsection
