<ul class="nav navbar-nav side-nav">
        <?php $resources = Laracancan::readableResources(); ?>
        <li class="nav-heading ">
                <span>Navigation</span>
        </li>
        <!-- Iterates over all sidebar items-->
        @foreach($resources as $resource)
                @if($resource->in_sidemenu == 1)
                        <li class="">
                                <a href="{{url($resource->name)}}" title="{{$resource->name}}">
                                        <em class="fa fa-{{$resource->icon_class}}"></em>
                                        <span>{{$resource['display_name_en']}}</span>
                                </a>
                        </li>
                @endif
        @endforeach
</ul>