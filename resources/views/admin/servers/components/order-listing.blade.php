<h4>Připraveno</h4>
<table class="table table-striped">
    <tr>
        <th>Položka</th>
        <th>Stav</th>
        <th>Změněno před</th>
        <th>Akce</th>
    </tr>
    @foreach($ready as $orderable)
        <tr>
            <td> {{ $orderable->orderable->name }}</td>
            <td> {{ $orderable->status }}</td>
            <td> {{ \App\Services\OrderableService::getDisplayElapsedTime($orderable->updated_at, true) }}</td>
            <td>
                <form method="post" action="{{route('admin.order-listing.deliver-order', ['id' => $orderable->id])}}">
                    <input class="form-control btn-warning btn-sm" type="submit" value="Servírovat">
                    {{csrf_field()}}
                </form>
            </td>
        </tr>

    @endforeach
</table>

<h4>Servírováno</h4>
<table class="table table-striped">
    <tr>
        <th>Položka</th>
        <th>Stav</th>
        <th>Změněno před</th>
        <th>Akce</th>
    </tr>
    @foreach($served as $orderable)
        <tr>
            <td> {{ $orderable->orderable->name }}</td>
            <td> {{ $orderable->status }}</td>
            <td> {{ \App\Services\OrderableService::getDisplayElapsedTime($orderable->updated_at, true) }}</td>
            <td>
                <form method="post" action="{{route('admin.order-listing.remove-order', ['id' => $orderable->id])}}">
                    <input class="form-control btn-warning btn-sm" type="submit" value="Sklidit">
                    {{csrf_field()}}
                </form>
            </td>
        </tr>

    @endforeach
</table>

<h4>V přípravě</h4>
<table class="table table-striped">
    <tr>
        <th>Položka</th>
        <th>Stav</th>
        <th>Změněno před</th>
    </tr>
    @foreach($beingPrepared as $orderable)
        <tr>
            <td> {{ $orderable->orderable->name }}</td>
            <td> {{ $orderable->status }}</td>
            <td> {{ \App\Services\OrderableService::getDisplayElapsedTime($orderable->updated_at, true) }}</td>
        </tr>

    @endforeach
</table>

<h4>Přijato</h4>
<table class="table table-striped">
    <tr>
        <th>Položka</th>
        <th>Stav</th>
        <th>Změněno před</th>
    </tr>
    @foreach($accepted as $orderable)
        <tr>
            <td> {{ $orderable->orderable->name }}</td>
            <td> {{ $orderable->status }}</td>
            <td> {{ \App\Services\OrderableService::getDisplayElapsedTime($orderable->updated_at, true) }}</td>
        </tr>

    @endforeach
</table>

<h4>Sklizeno</h4>
<table class="table table-striped">
    <tr>
        <th>Položka</th>
        <th>Stav</th>
        <th>Změněno před</th>
    </tr>
    @foreach($removed as $orderable)
        <tr>
            <td> {{ $orderable->orderable->name }}</td>
            <td> {{ $orderable->status }}</td>
            <td> {{ \App\Services\OrderableService::getDisplayElapsedTime($orderable->updated_at, true) }}</td>
        </tr>

    @endforeach
</table>