@extends('layouts.master_admin')

@section('title','Все категории')

@section('content')
    <div class="uk-grid uk-grid-small">

        <div class="uk-width-medium-1-5">

            <div class="content">

                <a class="uk-button uk-button-primary uk-margin-bottom" href="{{ route('categories.create') }}">Создать категорию</a>

                <ul id="menu-category" class="uk-nav uk-nav-parent-icon" data-uk-nav="{multiple:true}">
                    <li class="uk-nav-header">
                        <a href="{{ route('categories.index') }}">Корневой раздел</a>
                    </li>
                    @foreach((array)$menus as $menu)
                        @if(!empty($menu['children']))
                            <li class="uk-parent">
                                <a href="#">{{ $menu['nav_title'] }}</a>
                                <ul class="uk-nav-sub">
                                    <li>
                                        <a class="uk-text-bold m-sort" href="#" data-id="{{ $menu['id'] }}">{{ $menu['nav_title'] }} все</a>
                                    </li>
                                    @foreach((array)$menu['children'] as $child)
                                        @include('admin.categories.cat_menu',['menu' => $child])
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
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

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});

        $('#response').on('change.uk.sortable', function () {
            $('#save-category').show();
        });

        $('#menu-category').on('click','.m-sort',function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.getJSON('categories/sort/gets',{id:id},function (json) {
               if(json['status'] === 1) {
                   $('#response').html(json['html']);
               }
            })

        });

    });
</script>
@endpush