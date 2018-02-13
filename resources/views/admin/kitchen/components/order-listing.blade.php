<h4>K vyhotovení</h4>
<table class="table table-striped">
    <tr>
        <th>Položka</th>
        <th>Stav</th>
        <th>Změněno před</th>
        <th>Akce</th>
    </tr>
    @foreach($accepted as $orderable)
        <tr>
            <td> {{ $orderable->orderable->name }}</td>
            <td> {{ $orderable->status }}</td>
            <td> {{ \App\Services\OrderableService::getDisplayElapsedTime($orderable->updated_at, true) }}</td>
            <td>
                <form method="post" action="{{route('admin.order-listing.start-preparation', ['id' => $orderable->id])}}">
                    <input class="form-control btn-warning btn-sm" type="submit" value="Začít připravovat">
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
        <th>Akce</th>
    </tr>
    @foreach($beingPrepared as $orderable)
        <tr>
            <td> {{ $orderable->orderable->name }}</td>
            <td> {{ $orderable->status }}</td>
            <td> {{ \App\Services\OrderableService::getDisplayElapsedTime($orderable->updated_at, true) }}</td>
            <td>
                <form method="post" action="{{route('admin.order-listing.finish-preparation', ['id' => $orderable->id])}}">
                    <input class="form-control btn-success btn-sm" type="submit" value="Připraveno">
                    {{csrf_field()}}
                </form>
            </td>
        </tr>

    @endforeach
</table>