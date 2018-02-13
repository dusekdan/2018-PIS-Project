<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">

<div class="row iframe-inside">
<div class="col-md-6" style="margin:auto;margin-top: 15px;">
    @if (!empty($order))
        {{-- Single order bookables - chairs, mainly and a saloon --}}
            <h4> {{ $order->bookable->name}}: Objednávka </h4>
            <hr>
            <b>Přidat položku</b><br>
            <form method="post" action="{{ route('admin.order-bookable', ['id' => $order->id ])}}">
                <div class="form-group">
                    <label for="order-type" class="required">Typ položky</label>
                    <select name="order-type" id="order-type" onchange="updateOrderableDataSource()" title="order-type" class="form-control">
                        <option>Načítání možností...</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="order-item" class="required">Položka</label>
                    <select name="order-item" id="order-item" title="order-item" class="form-control">
                        <option>Načítání možností...</option>
                    </select>
                </div>
                {{ csrf_field() }}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Přidat položku</button>
                </div>
            </form>
            <script type="text/javascript">
                var orderableTypes = {!! $types !!};
                var orderables = {!! $orderables !!};

                function loadOrderableTypeDataSource()
                {
                    // !! no-escape, so possibly XSS can get through.
                    var selectElement = document.getElementById("order-type");
                    selectElement.innerHTML = generateOptionString(orderableTypes);

                    // Pre-load meal type
                    updateOrderableDataSource();
                }

                function generateOptionString(values){
                    var resultString = "";
                    for (var i = 0; i < values.length; i++){
                        resultString += "<option value='"+ values[i]['id'] +"'>" +  values[i]['name'] + "</option>";
                    }
                    return resultString;
                }

                function updateOrderableDataSource(){
                    var selectElement = document.getElementById("order-type");
                    var selectedType = selectElement.options[selectElement.selectedIndex].value;

                    var mealSelect = document.getElementById("order-item");
                    mealSelect.innerHTML = getOrderablesDataSourceByType(selectedType);
                }

                function getOrderablesDataSourceByType(type){
                    var resultString = "";
                    for (var i = 0; i < orderables.length; i++){
                        if (orderables[i]['orderable_type_id'] == type){
                            resultString += "<option value='" + orderables[i]['id'] + "'>" + orderables[i]['name'] + "</option>";
                        }
                    }
                    return resultString;
                }

                loadOrderableTypeDataSource(); // Load data to order-type select box
            </script>
            <hr>

            <strong>Položky:</strong>
            <ul>
                @foreach ($order->order_orderables as $orderItem)
                    <li>
                     <div class="row">
                      <div class="col-md-10">
                            {{$orderItem->orderable->name}} (cena {{ $orderItem->orderable->price }}, stav: {{ $orderItem->status  }})
                      </div>
                      <div class="col-md-2">
                        <form class="form-inline" method="post" action="{{route('admin.order-bookable.delete', [$order->id])}}">
                            <input type="hidden" name="order-item-id" value="{{$orderItem->id}}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn-danger btn btn-sm" onclick="return confirm('Jste si jistý/á, že chcete tuto položku odstranit? Tuto akci nebude možné vzít zpět.')" value="Odstranit">
                        </form>
                      </div>
                     </div>

                    </li>
                @endforeach
            </ul>

            <strong>Celková cena: </strong> {{ \App\Services\OrderService::calculateOrderPrice($order->id)}}
            <br><br>
            <div class="row">
                <div class="col-md-4">
                    <form method="post" action="{{route('admin.order-bookable-pay', [$order->id])}}">
                        <input type="submit" value="Zaplatit / uzavřít objednávku" class="btn btn-warning btn-sm form-control">
                        {{  csrf_field() }}
                    </form>
                </div>
            </div>
            <hr>

    @elseif (!empty($orders))
            @if (!empty($orders->where('bookable_id', $bookableId)->first()))
            {{-- Multi-order bookables (tables) --}}
            <h3>Útrata za stůl: {{\App\Services\OrderService::calculateOrderPriceForAllBookables($bookableId)}}</h3>
            <div class="row">
                <div class="col-md-4">
                <form method="post" action="{{route('admin.order-bookable-multipay', [$bookableId])}}">
                    <input type="submit" value="Zaplatit / uzavřít objednávku" class="btn btn-warning btn-sm form-control">
                    {{  csrf_field() }}
                </form>
                </div>
            </div>
            <hr>
            <b>Přidat položku</b><br>

            <form method="post" action="{{ route('admin.order-bookable', [
            'id' => $orders->where('bookable_id', $bookableId)->first()->id
            ])
            }}">
                <div class="form-group">
                    <label for="order-type" class="required">Typ položky</label>
                    <select name="order-type" id="order-type" onchange="updateOrderableDataSource()" title="order-type" class="form-control">
                        <option>Načítání možností...</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="order-item" class="required">Položka</label>
                    <select name="order-item" id="order-item" title="order-item" class="form-control">
                        <option>Načítání možností...</option>
                    </select>
                </div>
                {{ csrf_field() }}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Přidat položku</button>
                </div>
            </form>
            <script type="text/javascript">
            var orderableTypes = {!! $types !!};
            var orderables = {!! $orderables !!};

            function loadOrderableTypeDataSource(){
                // !! no-escape, so possibly XSS can get through.
                var selectElement = document.getElementById("order-type");
                selectElement.innerHTML = generateOptionString(orderableTypes);

                // Pre-load meal type
                updateOrderableDataSource();
            }

            function generateOptionString(values){
                var resultString = "";
                for (var i = 0; i < values.length; i++){
                    resultString += "<option value='"+ values[i]['id'] +"'>" +  values[i]['name'] + "</option>";
                }

                return resultString;
            }

            function updateOrderableDataSource(){
                var selectElement = document.getElementById("order-type");
                var selectedType = selectElement.options[selectElement.selectedIndex].value;

                var mealSelect = document.getElementById("order-item");
                mealSelect.innerHTML = getOrderablesDataSourceByType(selectedType);
            }

            function getOrderablesDataSourceByType(type){
                var resultString = "";
                for (var i = 0; i < orderables.length; i++){
                    if (orderables[i]['orderable_type_id'] == type){
                        resultString += "<option value='" + orderables[i]['id'] + "'>" + orderables[i]['name'] + "</option>";
                    }
                }
                return resultString;
            }
            loadOrderableTypeDataSource();  // Load data to order-type select box
            </script>
            @else

                <div class="alert alert-primary" role="alert">
                    <p>Neexistuje žádná otevřená objednávka pro celý stůl. </p>

                    <div class="col-md-3">
                        <form method="post" action="{{route('admin.order-bookable.create', [$bookableId])}}">
                            <input class="form-control btn btn-primary btn-xs" type="submit" value="Vytvořit">
                            {{ csrf_field() }}
                        </form>
                    </div>

                </div>
            @endif
            {{-- Multi order bookables --}}
            @foreach ($orders as $order)
                <h4>{{ $order->bookable->name}}: Objednávka</h4>

                <strong>Položky:</strong>
                <ul>
                    @foreach ($order->order_orderables as $orderItem)
                        <li>
                            <div class="row">
                            <div class="col-md-10">
                            {{$orderItem->orderable->name}} (cena {{ $orderItem->orderable->price }}, stav:
                            {{ $orderItem->status  }})
                                </div>
                            <div class="col-md-2">
                                <form  class="form-inline" method="post" action="{{route('admin.order-bookable.delete', [$order->id])}}">
                                    <input type="hidden" name="order-item-id" value="{{$orderItem->id}}">
                                    {{ csrf_field() }}
                                    <input type="submit"  class="btn-danger btn btn-sm" onclick="return confirm('Jste si jistý/á, že chcete tuto položku odstranit? Tuto akci nebude možné vzít zpět.')" value="Odstranit">
                                </form>
                            </div>
                            </div>

                        </li>

                    @endforeach

                    <strong>Cena objednávky pro jednotku: </strong> {{ \App\Services\OrderService::calculateOrderPrice($order->id)}}
                <div class="row">
                    <div class="col-md-4">
                    <form method="post" action="{{route('admin.order-bookable-pay', [$order->id])}}">
                        <input type="submit" value="Zaplatit / uzavřít objednávku" class="btn btn-warning btn-sm form-control">
                        {{  csrf_field() }}
                    </form>
                    </div>
                </div>

                </ul>

            @endforeach
    @else

        <div class="alert alert-primary" role="alert">
            <p>Neexistuje žádná otevřená objednávka pro tuto rezervovatelnou jednotku. </p>

            <div class="col-md-3">
                <form method="post" action="{{route('admin.order-bookable.create', [$bookableId])}}">
                    <input class="form-control btn btn-primary btn-xs" type="submit" value="Vytvořit">
                    {{ csrf_field() }}
                </form>
            </div>

        </div>
    @endif
</div>
</div>