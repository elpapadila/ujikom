<li class="nav-item active">
    <a class="nav-link {{Request::segment(1) == $url ? 'active' : ''}}" href="{{url($url)}}">
        <i class="nav-icon {{$icon ?? 'fas fa-circle'}}"></i>
        <span>{{$title}}</span></a>
</li>
