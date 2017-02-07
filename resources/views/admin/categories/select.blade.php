@foreach($categories as $key => $value)
    @if(empty($category) || $category->id !== $value['id'])
    <option value="{{ $key }}" @if($id === $key) selected @endif>{{ str_repeat('&crarr;', $shift) }} {{ $value['nav_title'] }}</option>
    @endif
    @if(!empty($value['children']) && (empty($category) || $category->id !== $value['id']))
        @include('admin.categories.select',['categories' => $value['children'],'shift' => $shift + 1])
    @endif
@endforeach