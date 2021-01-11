@extends('cms.layouts.app')
@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            @include('cms.layouts.breadcrumb')

            <div class="d-flex align-items-center">
                <a href="javascript:;" onclick="addCategories()"  class="btn btn-primary btn-sm font-weight-bold mr-2">
                    <i class="flaticon2-plus-1 icon-nm"></i> Yeni Branş Ekle
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
                                        @foreach($blocks as $block)
                                            <li class="dd-item dd3-item item{{ $block->id }}" data-id="{{ $block->id }}">
                                                <div class="dd-handle dd3-handle">Drag</div>
                                                <div class="dd3-content">
                                                    <span id="title">
                                                     @if($block->lessonid != 0)
                                                        {{ $block->title }}
                                                     @else
                                                         {{ \App\Models\Cms\HomeLessons::LESSONS[$block->system] }}
                                                     @endif
                                                    </span>
                                                    @if($block->lessonid != 0)
                                                        <span class="span-right categoryButtonChange">
                                                            <a class="edit-button" id="editItem{{ $block->id }}" onclick="getItem('{{ $block->lessonid }}','{{ $block->id }}')">
                                                                <i class="fas fa-pencil-alt icon-nmo icon-color-gray"></i>
                                                            </a>
                                                            <a class="del-button" id="deleteItem{{ $block->id }}" onclick="deleteItem('{{ $block->id }}')">
                                                                <i class="fas fa-trash-alt icon-nmo icon-color-gray"></i>
                                                            </a>
                                                        </span>
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group showCategory" style="display: none;">
                                <select class="form-control select2" id="categories" name="categories" onchange="changeCategory(this)" style="width: 100%;">
                                    @if($allCategories)
                                        <option selected disabled>Branş Seçiniz</option>
                                        @foreach($allCategories as $allCategory)
                                            <option value="{{$allCategory->id}}">{{$allCategory->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="selected" value="0">
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.5.0/jquery.nestable.min.js"></script>
    <script src="{{url('backend/js/home_blocks.js')}}"></script>
@endsection
@section('cssFiles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.5.0/jquery.nestable.min.css"/>
    <link rel="stylesheet" href="{{url('backend/assets/css/categories.css')}}"/>
@endsection
