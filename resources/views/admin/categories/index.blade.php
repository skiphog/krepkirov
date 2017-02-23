@extends('layouts.master_admin')

@section('title','Все категории')

@section('content')
    <div class="uk-grid uk-grid-small">

        <div class="uk-width-medium-1-5">

            <div class="content">

                <a class="uk-button uk-button-primary uk-margin-bottom" href="{{ route('categories.create') }}">Создать категорию</a>

                <ul id="menu-category" class="uk-nav">
                    <li>
                        <a href="{{ route('categories.index') }}">Корневой раздел</a>
                        <ul class="uk-nav-sub">
                            @foreach((array)$menus as $menu)
                                <li>
                                    <a class="m-sort" href="#" data-id="{{ $menu['id'] }}">{{ $menu['nav_title'] }}</a>
                                    @if(!empty($menu['children']))
                                        @foreach((array)$menu['children'] as $child)
                                            @include('admin.categories.cat_menu',['menu' => $child])
                                        @endforeach
                                    @endif
                                </li>
                            @endforeach

                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="uk-width-medium-4-5">

            <h1 class="content uk-text-center">Категории</h1>

            @include('message.flash')

            <div id="response">
                @include('admin.categories.cat_form')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="/js/sortable.min.js"></script>
<script>

    $(document).ready(function () {

        $('#response').on('change.uk.sortable', function () {
            $('#save-category').show();
        });

        $('#menu-category').on('click','.m-sort',function (e) {
            e.preventDefault();

            getAjax('categories/sort/gets', 'get', 'html', function (h) {
                $('#response').html(h);
            }, [{name:'id',value:$(this).data('id')}]);

        });

    });
</script>
@endpush