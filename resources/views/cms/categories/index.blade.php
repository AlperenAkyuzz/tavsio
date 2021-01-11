@extends('cms.layouts.app')
@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            @include('cms.layouts.breadcrumb')

            <div class="d-flex align-items-center">
                <a href="javascript:;" onclick="selectType('add')"  class="btn btn-primary btn-sm font-weight-bold mr-2">
                    <i class="flaticon2-plus-1 icon-nm"></i> Yeni Kategori Ekle
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5" style="border-right: 1px solid #efefef">
                            <div class="cf nestable-lists">
                                <div class="dd" id="nestable3">
                                    <ol class="dd-list">
                                        @foreach($categories as $category)
                                            <li class="dd-item dd3-item @if(count($category->childs)){{'dd-collapsed'}}@endif item{{ $category->id }}" data-id="{{ $category->id }}" >
                                                <button class="dd-collapse" data-action="collapse" type="button" onclick="collapse('{{ $category->id }}')">Collapse</button>
                                                <button class="dd-expand" data-action="expand" type="button" onclick="expand('{{ $category->id }}')">Expand</button>
                                                <div class="dd-handle dd3-handle">Drag</div>
                                                <div class="dd3-content">{{ $category->title }}
                                                    <span class="span-right">
                                                        <a class="add-button" id="addItem{{ $category->id }}" onclick="selectType('add',true,'{{ $category->id }}')" data-name="{{ $category->title }}">
                                                            <i class="fas fa-folder-plus icon-nmo icon-color-gray"></i>
                                                        </a>
                                                        <a class="edit-button" id="editItem{{ $category->id }}" onclick="selectType('edit',true,'{{ $category->id }}')">
                                                            <i class="fas fa-pencil-alt icon-nmo icon-color-gray"></i>
                                                        </a>
                                                        <a class="del-button" id="deleteItem{{ $category->id }}" onclick="selectType('delete',true,'{{ $category->id }}')">
                                                            <i class="fas fa-trash-alt icon-nmo icon-color-gray"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="seletTypes" id="add-content">
                                <form id="addForm" class="form">
                                    <input type="hidden" id="action" value="insert">
                                    <input type="hidden" name="id" id="id" value="">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kategori Başlık * :</label>
                                                <input type="text" name="title" id="title" class="form-control form-control-solid"
                                                       placeholder="Kategori Başlığı"/>
                                                <span class="form-text text-muted">Lütfen kategori başlık alanını doldurunuz!</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Bağlı Olduğu Ders Kategorisi :</label>
                                                <select class="form-control select2" id="categories" name="categories">
                                                    <option value="0" selected>Ana Kategori Olarak Ekle</option>
                                                    @if($allCategories)
                                                        @foreach($allCategories as $allCategory)
                                                            <option value="{{$allCategory->id}}">{{$allCategory->title}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kategori Seo Başlık :</label>
                                                <input type="text" name="seo_title" id="seo_title" class="form-control form-control-solid" placeholder="Kategori Seo Başlığı"/>
                                                <span class="form-text text-muted">Lütfen kategori seo başlık alanını doldurunuz!</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kategori İkon :</label>
                                                <input type="text" name="icon" id="icon" class="form-control form-control-solid" placeholder="Örnek : fa fa-plus"/>
                                                <span class="form-text text-muted">İkonlar için <a href="https://fontawesome.com/icons?d=gallery" target="_blank">Fontawsome 5</a> adresini ziyaret edebilirsiniz.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Kategori Açıklama :</label>
                                        <textarea class="form-control form-control-solid" rows="3" name="description" id="description" placeholder="Kategori Seo Açıklaması"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="photo" class="control-label">Kategori Resmi</label>
                                                <input type="file" id="input-file-now" class="dropify photo" name="photo"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="requestPhoto" class="control-label">Kategori Talep Resmi</label>
                                                <input type="file" id="input-file-now" class="dropify requestPhoto" name="requestPhoto"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="bg" class="control-label">Kategori Arka Plan Resmi</label>
                                                <input type="file" id="input-file-now" class="dropify bg" name="bg"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox-list">
                                            <label class="checkbox">
                                                <input type="checkbox" name="status" id="status" value="1" checked/>
                                                <span></span>
                                                Kategori Aktif
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button type="submit" class="btn btn-success mr-2 btn-sm font-weight-bolder">
                                                <i class="fas fa-save"></i>  Formu Kaydet
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="url" value="{{url('/')}}">
    <input type="hidden" id="selectedCategory" value="0">
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.5.0/jquery.nestable.min.js"></script>
    <script src="{{asset('backend/dropify/js/dropify.min.js')}}" type="text/javascript"></script>
    <script src="{{url('backend/assets/js/categories.js?v=1.0.23')}}"></script>
@endsection
@section('cssFiles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.5.0/jquery.nestable.min.css" />
    <link rel="stylesheet" href="{{url('backend/assets/css/categories.css')}}" />
    <link rel="stylesheet" href="{{url('backend/dropify/css/dropify.css')}}" />
@endsection
