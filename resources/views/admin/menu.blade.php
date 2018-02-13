@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if (Auth::user()->hasRole('kuchar'))
    @include('admin.kitchen.main-menu')
@endif

@if (Auth::user()->hasRole('obsluha'))
    @include('admin.servers.main-menu')
@endif

@if (Auth::user()->hasRole('kancelar'))
    @include('admin.office.main-menu')
@endif

@if (Auth::user()->hasRole('manager'))
    @include('admin.manager.main-menu')
@endif