@if(!$products->isEmpty())
    {!! Form::open([
        'action' => 'Admin\ProductController@saveSortProduct',
        'class' =>'content uk-margin-bottom uk-sortable',
        'data-uk-sortable' => '{handleClass:\'uk-sortable-handle\'}'])
    !!}
    @foreach($products as $product)
        <div>
            <div class="content uk-grid uk-grid-collapse uk-flex-middle uk-margin-small-bottom">
                <div class="uk-width-medium-1-6">
                    <i class="uk-sortable-handle uk-icon uk-icon-arrows uk-margin-small-right"></i>
                    <img src="{{ !empty($product->image) ? '/images/catalog/' . $product->image . '.jpg': '/images/' . config('s.default_img_product') }}" alt="image" width="50">
                </div>
                <div class="uk-width-medium-2-6">
                    <a class="show-product" href="{{ action('Admin\ProductController@edit',['$product' => $product->id]) }}">{{ $product->name }}</a>
                </div>
                <div class="uk-width-medium-1-6">
                    {{ number_format((float)$product->weight, 2, ',', ' ') }} кг
                </div>
                <div class="uk-width-medium-1-6">
                    {{ $product->unit }}
                </div>
                <div class="uk-width-medium-1-6 uk-clearfix">
                    {{ number_format((float)$product->price_1, 2, ',', ' ') }}
                    <a data-id="{{ $product->id }}" class="uk-icon-hover uk-icon-times del-product uk-float-right uk-margin-right"></a>
                </div>
                {!! Form::hidden('product[]',$product->id) !!}
            </div>
        </div>
    @endforeach

    {!! Form::submit('Сохранить',['class' => 'uk-button uk-button-primary uk-margin-top','id' => 'save-product','style'=> 'display:none']) !!}
    {!! Form::close() !!}

@else
    <div class="uk-alert">
        <h2 class="uk-text-center">В этой категории нет товаров</h2>
    </div>
@endif