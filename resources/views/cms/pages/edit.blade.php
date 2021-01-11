@extends('cms.layouts.app')
@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            @include('cms.layouts.breadcrumb')
            <div class="d-flex align-items-center">
                <a href="{{url('tavsiocms/pages')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-3">
                    <i class="fas fa-hand-point-left"></i> Geri Dön
                </a>
                <a href="{{url('tavsiocms/pages')}}" class="btn btn-light-danger font-weight-bolder btn-sm">
                    <i class="far fa-times-circle"></i> İptal Et
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <form class="form" action="{{url('tavsiocms/pages/edit/'.$pages->uuid)}}" method="post">
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Başlık :</label>
                                    <input type="text" name="title" value="{{$pages->title}}" class="form-control form-control-solid" placeholder="Sayfa Başlığı"/>
                                    <span class="form-text text-muted">Lütfen başlık alanını doldurunuz!</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Kategoriler :</label>
                                    <select class="form-control select2" id="category" name="category">
                                        <option selected disabled>Kategori Seçiniz</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if($category->id == $pages->categoryid) {{'selected'}} @endif>{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Açıklama :</label>
                            <textarea class="form-control form-control-solid" rows="3"
                                      name="description" id="description" placeholder="Sayfa Seo Açıklaması">{{$pages->description}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="detail">İçerik :</label>
                            <textarea name="detail" id="detail" class="detail">{!! $pages->detail !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Durumu :</label>
                            <div class="checkbox-list">
                                <label class="checkbox">
                                    <input type="checkbox" name="status" value="1" @if($pages->status == 1) {{'checked'}} @endif/>
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
@section('js')
    <!--begin::Page Vendors(used by this page)-->
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <!--end::Page Vendors-->
    <script type="text/javascript">
        $('.select2').select2();
        CKEDITOR.replace('detail', {
            height: '200px',
            extraPlugins: 'forms',
            customConfig: '{{asset('backend/ckeditor/custom.js')}}'
        });
    </script>
@endsection
