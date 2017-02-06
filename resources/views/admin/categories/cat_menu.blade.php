@if(!empty($menu['children']))
    <li>
    <a href="#" class="m-sort" data-id="{{ $menu['id'] }}">{{ $menu['nav_title'] }}</a>
        <ul>
            @foreach($menu['children'] as $child)
                @include('admin.categories.cat_menu',['menu' => $child])
            @endforeach
        </ul>
    </li>
@endif