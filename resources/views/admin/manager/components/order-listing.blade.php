<h4>Dnešní dokončené objednávky</h4>
<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Datum a čas</th>
        <th>Cena</th>
    </tr>
    @foreach($todays as $order)
        <tr>
            <td> {{ $order->id }}</td>
            <td> {{ $order->updated_at }}</td>
            <td> {{ \App\Services\OrderService::calculateOrderPrice($order->id) }} CZK </td>
        </tr>

    @endforeach
</table>

<h4>Historické objednávky</h4>
<table class="table table-striped">
    <tr>
        <th>Položka</th>
        <th>Datum a čas</th>
        <th>Cena</th>
    </tr>
    @foreach($historic as $order)
        <tr>
            <td> {{ $order->id }}</td>
            <td> {{ $order->updated_at }}</td>
            <td> {{ \App\Services\OrderService::calculateOrderPrice($order->id) }} CZK </td>
        </tr>
    @endforeach
</table>


{{ $historic->links()  }}