@if(!$products->isEmpty())
    <table class="uk-table uk-table-middle content">
        <thead>
        <tr>
            <th><i class="uk-icon-image"></i></th>
            <th>Наименование</th>
            <th>Категория</th>
            <th>Вес</th>
            <th>Ед. изм</th>
            <th>Розница</th>
            <th><i class="uk-icon-times"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td><img src="{{ !empty($product->image) ? '/images/catalog/' . $product->image . '.jpg': '/images/' . config('s.default_img_product') }}" alt="image" width="50"></td>
                <td><a class="show-product" href="{{ action('Admin\ProductController@edit',['$product' => $product->id]) }}">{{ $product->name }}</a></td>
                <td>{{ !empty($product->title) ? $product->title : 'Без категории' }}</td>
                <td>{{ number_format((float)$product->weight, 2, ',', ' ') }} кг</td>
                <td>{{ $product->unit }}</td>
                <td>{{ number_format((float)$product->price_1, 2, ',', ' ') }}</td>
                <td><a data-id="{{ $product->id }}" class="uk-icon-hover uk-icon-times del-product"></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="uk-alert">
        <h2 class="uk-text-center">Список пуст</h2>
    </div>
@endif