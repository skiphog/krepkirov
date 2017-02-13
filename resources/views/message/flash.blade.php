@if(Session::has('flash'))
    <div class="uk-alert uk-alert-success" data-uk-alert>
        <a class="uk-alert-close uk-close"></a>
        <p>{{ Session::get('flash') }}</p>
    </div>
@endif