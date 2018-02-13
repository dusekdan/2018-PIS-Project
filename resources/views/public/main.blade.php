@extends('public.app')

@section('content')

    <!-- Menu -->
    <div class="container text-center" id="menu">
        <h3>AKTUÁLNÍ MENU</h3>

        @foreach($upcomingMenus as $menu)
            {{-- 1 day menu vs longer duration menu --}}
            @if (strftime("%d. %m. %Y", strtotime($menu->validityStart)) == strftime("%d. %m. %Y", strtotime($menu->validityEnd)))
            <p><em><span class="datum">{{\App\Services\MenuService::getCzechDayName($menu->validityStart)}}, {{strftime("%d. %m. %Y", strtotime($menu->validityStart))}}</span></em></p>
            @else
                <p><em><span class="datum">Platné od {{strftime("%d. %m. %Y", strtotime($menu->validityStart))}}&nbsp;do&nbsp;{{strftime("%d. %m. %Y", strtotime($menu->validityEnd))}}</span></em></p>
            @endif

            <br>

            {{-- Menu items --}}
            <p>{{ $menu->meal_1->name }} {{\App\Services\MenuService::getPriceString($menu, 1)}}</p>
            <p>{{ $menu->meal_2->name ?? ""}}  {{\App\Services\MenuService::getPriceString($menu, 2)}}</p>
            <p>{{ ($menu->meal_3->name ?? "")}} {{\App\Services\MenuService::getPriceString($menu, 3)}}</p>

            <hr>
        @endforeach
    </div>


@endsection

