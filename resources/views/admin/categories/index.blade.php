@extends('layouts.master_admin')

@section('title','Все категории')

@section('content')
    <div class="uk-grid-small" uk-grid>

        <div class="uk-width-1-4@m uk-visible@m">

            <div class="uk-card uk-card-default uk-card-body">


                <a class="uk-button uk-button-default uk-margin-large-bottom" href="{{ route('categories.create') }}">Создать категорию</a>

                <ul id="menu-category" class="uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true">
                    <li class="uk-nav-header">
                        <a href="{{ route('categories.index') }}">Админ Каталог</a>
                    </li>
                    @foreach($menus as $menu)
                        @if(!empty($menu['children']))
                            <li class="uk-parent">
                                <a href="#">{{ $menu['nav_title'] }}</a>
                                <ul class="uk-nav-sub" hidden="hidden">
                                    <li>
                                        <a class="uk-text-bold m-sort" href="#" data-id="{{ $menu['id'] }}">{{ $menu['nav_title'] }} все</a>
                                    </li>
                                    @foreach($menu['children'] as $child)
                                        @include('admin.categories.cat_menu',['menu' => $child])
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="uk-width-3-4@m">

            <div class="content uk-box-shadow-medium uk-margin-bottom">

                <h1 class="uk-text-center">Категории</h1>
            </div>

            <hr class="uk-divider-icon">


            <div id="response" class="content uk-box-shadow-medium uk-margin-bottom uk-padding">
                @include('message.flash')
                @include('admin.categories.cat_form')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});

        $('#response').on('change', function () {
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