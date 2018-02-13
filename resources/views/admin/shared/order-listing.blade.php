@extends('admin.home')

@section('subpage-contents')
    <h5 class="display-5">Objednávky</h5>
    <!-- Print out order list -->
    @if ($role->name == 'obsluha')
        @component('admin.servers.components.order-listing', ['accepted' => $accepted, 'ready' => $ready, 'beingPrepared' => $beingPrepared, 'served' => $served, 'removed' => $removed])
        @endcomponent
    @elseif ($role->name == 'kuchar')
        @component('admin.kitchen.components.order-listing', ['accepted' => $accepted, 'beingPrepared' => $beingPrepared])
        @endcomponent
    @else
        {{-- Office & Manager --}}
        @component('admin.manager.components.order-listing', ['todays' => $todays, 'historic' => $historic])
        @endcomponent
    @endif
@endsection