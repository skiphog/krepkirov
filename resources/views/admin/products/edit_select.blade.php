@foreach($categories as $key => $value)
    <option value="{{ $key }}" @if($product->category_id === $key) selected @endif>{{ str_repeat('&crarr;', $shift) }} {{ empty($value['children']) ? '&bull;':'' }} {{ $value['nav_title'] }}</option>
    @if(!empty($value['children']))
        @include('admin.products.edit_select',['categories' => $value['children'],'shift' => $shift + 1])
    @endif
@endforeach