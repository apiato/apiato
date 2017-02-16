{{--
    This partial renders the error messages from actions or tasks.
--}}
        
@if (\Session::has('error') && !empty(\Session::get('error')))
    <div class="alert alert-danger alert-dismissible margin-top-10" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ trans('admin::views.error') }}</strong><br>
        
        @if(is_array(session('error')))
        
            @foreach(\Session::get('error') as $error)
                <div>
                {{ $error }}
                </div>
            @endforeach
            
        @else
            <div>
                {{ session('error') }}
            </div>
        @endif
        
    </div>
@endif