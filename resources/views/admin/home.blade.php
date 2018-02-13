@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Vítejte v restauračním systému Dionysus v0.1!</div>

                <div class="card-body">

                    {{-- Vykreslení příslušného menu pro právě přihlášenou roli uživatele. --}}
                    @include('admin.menu')

                    {{--
                        View, který realizuje konkrétní vybranou položku menu (například admin.shared.menu-editor
                        musí dědit tento view (@extends('admin.home')) a implementovat sekci 'subpage-contents' (
                        @section('subpage-contents')).
                    --}}
                    <hr>

                    @hasSection('subpage-contents')
                        @yield('subpage-contents')
                    @else
                        @include('admin.shared.room-plan')
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
