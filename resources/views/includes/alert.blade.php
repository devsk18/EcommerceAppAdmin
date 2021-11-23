@if(Session::has('error'))
<p class="alert text-danger p-0">
    {{ Session::get('error') }}
</p>
@elseif(Session::has('success'))
<p class="alert text-success p-0">
    {{ Session::get('success') }}
</p>
@endif