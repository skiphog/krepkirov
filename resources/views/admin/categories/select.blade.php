@foreach($categories as $key => $value)
    <option value="{{ $key }}" @if($id === $key) selected @endif>{{ str_repeat('&crarr;', $shift) }} {{ $value['nav_title'] }}</option>
    @if(!empty($value['children']))
        @include('admin.categories.select',['categories' => $value['children'],'shift' => $shift + 1])
    @endif
@endforeach