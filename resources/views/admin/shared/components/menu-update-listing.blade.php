<h4>Současná a nadcházející menu</h4>

    <table class="table table-striped">
        <tr>
            <th style="width: 33%;">Jméno /<br>Začátek / Konec</th>
            <th style="width: 52%;">Položky</th>
            <th style="width: 15%;">Akce</th>
        </tr>
        @foreach($upcomingMenus as $menu)
            <tr>
                <td class="align-middle">
                    <strong>{{$menu->name}}</strong>
                    <br>
                    Platnost<br> {{strftime("%d. %m. %Y", strtotime($menu->validityStart))}} <br>-<br>{{strftime("%d. %m. %Y", strtotime($menu->validityEnd))}}
                    <br>
                </td>
                <td class="align-middle">
                    {{ $menu->meal_1->name }} {{\App\Services\MenuService::getPriceString($menu, 1)}} <br><br>
                    {{ $menu->meal_2->name ?? ""}}  {{\App\Services\MenuService::getPriceString($menu, 2)}}<br><br>
                    {{ ($menu->meal_3->name ?? "")}} {{\App\Services\MenuService::getPriceString($menu, 3)}}<br><br>
                </td>
                <td class="align-middle">
                    <form class="form-inline float-left" method="post" action="{{ route('admin.menu-editor.delete', ['id' => $menu->id]) }}">
                        <input onclick="return confirm('Jste si jistý/á, že chcete toto menu odstranit? Tuto akci nebude možné vzít zpět.')"
                               class="form-control btn-danger btn-xs" type="submit" value="Odstranit">
                        {{ csrf_field() }}
                    </form>
                    <br><br>
                    <a class="btn btn-warning btn-xs" href="{{route('admin.menu-editor.edit', ['id' => $menu->id])}}">&nbsp;&nbsp;Upravit&nbsp;&nbsp;</a>
                </td>
            </tr>
        @endforeach
    </table>


<h4>Historie menu</h4>

<table class="table table-striped">
    <tr>
        <th style="width: 33%;">Jméno <br>(Začátek / Konec) <br> <em>Cena</em></th>
        <th style="width: 67%;">Položky</th>
    </tr>
    @foreach($pastMenus as $menu)
        <tr>
            <td class="align-middle">
                <strong>{{$menu->name}}</strong>
                <br>
                Platnost<br> {{strftime("%d. %m. %Y", strtotime($menu->validityStart))}} <br>-<br>{{strftime("%d. %m. %Y", strtotime($menu->validityEnd))}}
                <br>
            </td>
            <td class="align-middle">
                {{ $menu->meal_1->name }} {{\App\Services\MenuService::getPriceString($menu, 1)}} <br><br>
                {{ $menu->meal_2->name ?? ""}}  {{\App\Services\MenuService::getPriceString($menu, 2)}}<br><br>
                {{ ($menu->meal_3->name ?? "")}} {{\App\Services\MenuService::getPriceString($menu, 3)}}<br><br>
            </td>
        </tr>
    @endforeach
</table>