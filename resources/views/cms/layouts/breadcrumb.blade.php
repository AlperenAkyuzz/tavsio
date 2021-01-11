@if($breadcrumbs)
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold my-1 mr-5">{{$title ?? ''}}</h5>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{url('tavsiocms')}}" class="text-muted">Anasayfa</a>
            </li>
            @foreach($breadcrumbs as $url => $name)
                <li class="breadcrumb-item">
                    <a href="{{'/tavsiocms/'.$url}}" class="text-muted">{{$name}}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
