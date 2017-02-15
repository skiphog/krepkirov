{!! Form::open([
    'action' => 'Admin\CategoryController@saveSortCategory',
    'class' =>'content uk-margin-bottom uk-sortable',
    'data-uk-sortable' => '{handleClass:\'uk-sortable-handle\'}'])
!!}
@foreach($categories as $category)
<div>
    <div class="content uk-grid uk-grid-collapse uk-flex-middle uk-margin-small-bottom">
        <div class="uk-width-medium-1-5">
            <i class="uk-sortable-handle uk-icon uk-icon-arrows uk-margin-small-right"></i>
            <img width="75" src="/images/{{ $category->img }}" alt="{{ $category->title }}">
        </div>
        <div class="uk-width-medium-4-5">
            <a href="{{ route('categories.edit',['id' => $category->id]) }}" class="show-product">{{ $category->title }}</a>
        </div>
        {!! Form::hidden('category[]',$category->id) !!}
    </div>
</div>
@endforeach

{!! Form::submit('Сохранить',['class' => 'uk-button uk-button-primary uk-margin-top','id' => 'save-category','style'=> 'display:none']) !!}
{!! Form::close() !!}