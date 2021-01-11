@extends('cms.layouts.app')
@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            @include('cms.layouts.breadcrumb')
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row" id="wrapper">
                @foreach($blocks as $block)
                    <div class="col-lg-4 box mb-2" data-uuid="{{$block->uuid}}">
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title" style="width: 82%;">
                                    <select class="form-control select2" onchange="changeLessonData('{{$block->uuid}}',this.value)">
                                        @foreach($lessons as $lesson)
                                            <option value="{{$lesson->id}}" @if($lesson->id == $block->lessonid) {{'selected'}} @endif>{{$lesson->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="card-toolbar">
                                    <a href="javascript:;" class="btn btn-icon btn-sm btn-hover-light-primary">
                                        <i class="flaticon2-menu"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.1/Sortable.min.js"></script>
    <script src="{{url('backend/js/home_management.js')}}"></script>
@endsection
