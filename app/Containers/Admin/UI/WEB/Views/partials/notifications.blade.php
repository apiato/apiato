{{-- Notification Messages --}}
<div id="system-notifications" class="row">

    <div class="col-sm-8 col-sm-offset-2">
        
        {{--
            Validation error notification.
        --}}
        @if (isset($errors) && !$errors->isEmpty())
            <div class="alert alert-danger alert-dismissible margin-top-10" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Error!!</strong>
                <p>Hay problemas con la información suministrada.</p>
            </div>
        @endif

        @include('core::partials.notifications.success')
        @include('core::partials.notifications.warning')
        @include('core::partials.notifications.error')
    </div>
</div>