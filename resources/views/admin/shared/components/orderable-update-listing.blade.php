<h4>Existující položky</h4>
<div class="alert alert-info">
    <strong>Pozor! </strong> Položky, které již byly použity v objednávce není možné smazat.
</div>

<!-- Print out existing orderables by their types-->
<h5>Pití</h5>
<table class="table table-striped">
    <tr>
        <th style="width:33%;">Název</th>
        <th style="width:27%;">Množství / Cena</th>
        <th style="width:40%;">Akce</th>
    </tr>
    @foreach ($orderables as $orderable)
        @if ($orderable->orderable_type->name == "Pití")
            <tr>
                <td>{{ $orderable->name }}</td>
                <td>{{ $orderable->quantity }} / {{ $orderable->price }}</td>
                <td>
                    <form class="form-inline float-left" method="post" action="{{ route('admin.orderables-management.delete', ['id' => $orderable->id]) }}">
                        <input onclick="return confirm('Jste si jistý, že chcete tuto objednatelnou položku odstranit?')"
                               class="form-control btn-danger btn-sm" type="submit" value="Odstranit">
                        {{ csrf_field() }}
                    </form>
                    &nbsp;/&nbsp;
                    <a class="btn btn-warning btn-sm" href="{{route('admin.orderables-management.edit', ['id' => $orderable->id])}}">&nbsp;&nbsp;Upravit&nbsp;&nbsp;</a>
                </td>
            </tr>
        @endif
    @endforeach
</table>

<h5>Hlavní jídla</h5>
<table class="table table-striped">
    <tr>
        <th style="width:33%;">Název</th>
        <th style="width:27%;">Množství / Cena</th>
        <th style="width:40%;">Akce</th>
    </tr>
    @foreach ($orderables as $orderable)
        @if ($orderable->orderable_type->name == "Hlavní jídlo")
            <tr>
                <td>{{ $orderable->name }}</td>
                <td>{{ $orderable->quantity }} / {{ $orderable->price }}</td>
                <td>
                    <form class="form-inline float-left" method="post" action="{{ route('admin.orderables-management.delete', ['id' => $orderable->id]) }}">
                        <input onclick="return confirm('Jste si jistý, že chcete tuto objednatelnou položku odstranit?')"
                               role="button" class="form-control btn-danger btn-sm" type="submit" value="Odstranit">
                        {{ csrf_field() }}
                    </form>
                    &nbsp;/&nbsp;
                    <a class="btn btn-warning btn-sm" href="{{route('admin.orderables-management.edit', ['id' => $orderable->id])}}">&nbsp;&nbsp;Upravit&nbsp;&nbsp;</a>
                </td>
            </tr>
        @endif
    @endforeach
</table>

<h5>Polévky</h5>
<table class="table table-striped">
    <tr>
        <th style="width:33%;">Název</th>
        <th style="width:27%;">Množství / Cena</th>
        <th style="width:40%;">Akce</th>
    </tr>
    @foreach ($orderables as $orderable)
        @if ($orderable->orderable_type->name == "Polévka")
            <tr>
                <td>{{ $orderable->name }}</td>
                <td>{{ $orderable->quantity }} / {{ $orderable->price }}</td>
                <td>
                    <form class="form-inline float-left" method="post" action="{{ route('admin.orderables-management.delete', ['id' => $orderable->id]) }}">
                        <input onclick="return confirm('Jste si jistý, že chcete tuto objednatelnou položku odstranit?')"
                               class="form-control btn-danger btn-sm" type="submit" value="Odstranit">
                        {{ csrf_field() }}
                    </form>
                    &nbsp;/&nbsp;
                    <a class="btn btn-warning btn-sm" href="{{route('admin.orderables-management.edit', ['id' => $orderable->id])}}">&nbsp;&nbsp;Upravit&nbsp;&nbsp;</a>
                </td>
            </tr>
        @endif
    @endforeach
</table>

<h5>Pochutiny</h5>
<table class="table table-striped">
    <tr>
        <th style="width:33%;">Název</th>
        <th style="width:27%;">Množství / Cena</th>
        <th style="width:40%;">Akce</th>
    </tr>
    @foreach ($orderables as $orderable)
        @if ($orderable->orderable_type->name == "Pochutiny")
            <tr>
                <td>{{ $orderable->name }}</td>
                <td>{{ $orderable->quantity }} / {{ $orderable->price }}</td>
                <td>
                    <form class="form-inline float-left" method="post" action="{{ route('admin.orderables-management.delete', ['id' => $orderable->id]) }}">
                        <input onclick="return confirm('Jste si jistý, že chcete tuto objednatelnou položku odstranit?')"
                               class="form-control btn-danger btn-sm" type="submit" value="Odstranit">
                        {{ csrf_field() }}
                    </form>
                    &nbsp;/&nbsp;
                    <a class="btn btn-warning btn-sm" href="{{route('admin.orderables-management.edit', ['id' => $orderable->id])}}">&nbsp;&nbsp;Upravit&nbsp;&nbsp;</a>
                </td>
            </tr>
        @endif
    @endforeach
</table>