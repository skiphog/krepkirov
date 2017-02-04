<li @if($category->id === $menu['id']) class="uk-active" @endif>
    <a href="{{ url('catalog/' . $menu['full_url']) }}">{{ $menu['nav_title'] }}</a>
    @if(!empty($menu['children']))
    <ul>
        @foreach($menu['children'] as $child)
            @include('menu.cat_menu',['menu' => $child])
        @endforeach
    </ul>
    @endif
</li>