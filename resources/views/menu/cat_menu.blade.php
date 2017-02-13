<li @if($category->id === $menu['id']) class="uk-active" @endif>
    <a href="{{ url('catalog/' . $menu['full_url']) }}">{{ $menu['nav_title'] }}</a>
    @if(!empty($menu['children']) && strpos($category->full_url, $menu['full_url']) === 0)
        <ul>
            @foreach($menu['children'] as $child)
                @include('menu.cat_menu',['menu' => $child])
            @endforeach
        </ul>
    @endif
</li>