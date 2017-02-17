{{--
    This partial renders the warning messages from actions or tasks.
--}}
        
@if (\Session::has('warning') && !empty(\Session::get('warning')))
    <div class="alert alert-warning alert-dismissible margin-top-10" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ trans('admin::views.warning') }}</strong><br>
        @if(is_array(session('warning')))
        
            @foreach(\Session::get('warning') as $warning)
                <div>
                {{ $warning }}
                </div>
            @endforeach
        
        @else
            <div>
                {{ \Session::pull('warning') }}
            </div>
        @endif
    </div>
@endif