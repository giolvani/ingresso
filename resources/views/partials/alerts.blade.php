@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">{{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--}}{!! Session::get('success') !!}</div>
@endif

@if(Session::has('info'))
    <div class="alert alert-info">{{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--}}{!! Session::get('info') !!}</div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger">{{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--}}{!! Session::get('error') !!}</div>
@endif