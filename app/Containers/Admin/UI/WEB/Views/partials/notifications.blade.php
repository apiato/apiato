{{-- notification messages --}}
<div id="system-notifications" class="row">
    <div class="col-sm-8 col-sm-offset-2">
        
        {{-- validation error notification --}}
        @if (isset($errors) && !$errors->isEmpty())
            <div class="alert alert-danger alert-dismissible margin-top-10" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ trans('admin::views.error') }}</strong>
                <p>{{ trans('admin::views.there-are-errors-on-your-input') }}</p>
            </div>
        @endif

        @include('admin::partials.notifications.success')
        @include('admin::partials.notifications.warning')
        @include('admin::partials.notifications.error')
    </div>
</div>