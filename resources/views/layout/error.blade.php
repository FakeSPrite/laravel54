<div class="alert alert-danger" role="alter">
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach

</div>