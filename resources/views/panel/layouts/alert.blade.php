@if (Session::has('message'))
    <div class="alert alert-{{@Session::get('message')['alert']}}">{{@Session::get('message')['alert_message']}}</div>
@endif
