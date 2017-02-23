@if(!empty($menu['children']))
    <ul>
        <li>
            <a href="#" class="m-sort" data-id="{{ $menu['id'] }}">{{ $menu['nav_title'] }}</a>
        </li>
        @foreach((array)$menu['children'] as $child)
            @include('admin.categories.cat_menu',['menu' => $child])
        @endforeach
    </ul>
@endif