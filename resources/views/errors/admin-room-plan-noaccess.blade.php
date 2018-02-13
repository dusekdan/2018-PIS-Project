<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">

<div class="row iframe-inside">
    <div class="alert alert-danger" style="margin: auto;width: 75%;">
        <h5 class="alert-heading">Pozor!</h5>
        Nemáte oprávnění provádět  tuto operaci.
    </div>
</div>