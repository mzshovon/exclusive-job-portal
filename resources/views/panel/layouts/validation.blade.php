@if($errors->any())
    <div class="alert alert-danger">{!! implode('', $errors->all(':message')) !!}</div>
@endif