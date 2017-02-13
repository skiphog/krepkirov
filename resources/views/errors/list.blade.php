@if($errors->any())
    <div class="uk-alert uk-alert-danger" data-uk-alert>
        <a class="uk-alert-close uk-close"></a>
        @foreach((array)$errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif