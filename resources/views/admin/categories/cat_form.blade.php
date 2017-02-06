{!! Form::open(['action' => 'Admin\CategoryController@saveSortCategory']) !!}
<ul class="uk-list" uk-sortable="handle: .uk-sortable-handle">
    @foreach($categories as $category)
        <li>
            <div class="uk-card uk-card-small uk-card-default uk-card-body uk-grid-small uk-flex-middle" uk-grid>
                <div class="uk-width-1-5">
                    <span class="uk-sortable-handle uk-margin-small-right" uk-icon="icon: table"></span>
                    <img width="75" src="{{ asset('images/' . $category->img) }}" alt="{{ $category->title }}">
                </div>
                <div class="uk-width-3-5">
                    {{ $category->title }}
                </div>
                <div class="uk-width-1-5">
                    <a href="{{ route('categories.edit',['id' => $category->id]) }}" class="uk-icon-button uk-margin-left" uk-icon="icon: pencil" title="Редактировать" uk-tooltip="pos: left"></a>
                </div>
            </div>
            {!! Form::hidden('category[]',$category->id) !!}
        </li>
    @endforeach
</ul>

{!! Form::submit('Сохранить',['class' => 'uk-button uk-button-primary','id' => 'save-category','style'=> 'display:none']) !!}
{!! Form::close() !!}