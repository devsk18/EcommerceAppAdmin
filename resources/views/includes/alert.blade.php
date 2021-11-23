@if(Session::has('error'))
<p class="alert alert-danger" id="error">
    {{ Session::get('error') }}
    <button class="btn text-white" style="float: right;" onclick="document.getElementById('error').remove();"><strong>X</strong></button>
</p>
@elseif(Session::has('success'))
<p class="alert alert-success" id="success">
    {{ Session::get('success') }}
    <button class="btn text-white" style="float: right;" onclick="document.getElementById('success').remove();"><strong>X</strong></button>
</p>
@endif