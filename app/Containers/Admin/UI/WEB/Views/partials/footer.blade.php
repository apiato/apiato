{{-- main footer --}}
<footer class="main-footer footer">
    {{-- default to the left --}}
    <div class="col-sm-6">
    	<strong>{{ trans('admin::views.copyright') }}</strong> {{ config('app.name', 'Hello API') }} &copy; 2016
    </div>
    {{-- to the right --}}
    <div class="col-sm-6 pull-right text-right hidden-xs">
    	<a href="#">v 0.1</a>
    </div>
</footer>
{{-- /main footer --}}
