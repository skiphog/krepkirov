@foreach($categories as $key => $value)
    <option value="{{ $key }}">{{ str_repeat('&crarr;', $shift) }} {{ empty($value['children']) ? '&bull;':'' }} {{ $value['nav_title'] }}</option>
    @if(!empty($value['children']))
        @include('admin.products.select',['categories' => $value['children'],'shift' => $shift + 1])
    @endif
@endforeach