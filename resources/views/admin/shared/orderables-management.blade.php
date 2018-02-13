@extends('admin.home')

@section('subpage-contents')

    <div class="row">
        <!-- LEFT COLUMN: Adding Orderables -->
        <div class="col-lg-6" style="border-right: 1px solid lightgray">


            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <h5 class="alert-heading">Operace se nezdařila!</h5>
                    {{ \Session::get('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5 class="alert-heading">Přidání položky se nezdařilo!</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <h5 class="alert-heading">Úspěch!</h5>
                    {{ \Session::get('success') }}
                </div>
            @endif

            <h4>Přidat novou objednatelnou položku</h4>

            <form method="post" action="{{route('admin.orderables-management')}}">

                <div class="form-group">
                    <label for="orderable-name" class="required">Název</label>
                    <input
                            type="text"
                            id="orderable-name"
                            name="orderable-name"
                            title="orderable-name"
                            class="form-control"
                            required="required"
                            value="{{old('orderable-name')}}"
                    >
                </div>

                <div class="form-group">
                    <label for="orderable-quantity" class="required">Množství</label>
                    <input
                            type="text"
                            id="orderable-quantity"
                            name="orderable-quantity"
                            title="orderable-quantity"
                            class="form-control"
                            required="required"
                            value="{{old('orderable-quantity')}}"
                    >
                    <small id="orderable-quantity-help" class="form-text text-muted">Uveďte prosím množství a jednotku, například: 1 ks, 200 g, 300 ml, &hellip;.</small>
                </div>

                <div class="form-group">
                    <label for="orderable-price" class="required">Cena</label>
                    <input
                            type="text"
                            id="orderable-price"
                            name="orderable-price"
                            title="orderable-price"
                            class="form-control"
                            required="required"
                            value="{{old('price')}}"
                    >
                    <small id="orderable-price-help" class="form-text text-muted">Uveďte prosím cenu v přijatelném formátu: 10, 10.49.</small>
                </div>

                <div class="form-group">
                    <label for="orderable-type" class="required">Typ</label>
                    <select name="orderable-type" id="orderable-type" title="orderable-type" class="form-control" required="required">
                        @foreach ($types as $type)
                            <option
                                    value="{{$type->id}}"
                                    {{old('orderable-type') == $type->id ? 'selected' : '' }}
                            >
                                {{$type->name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{ csrf_field() }}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Přidat položku</button>
                </div>
            </form>


        </div>

        <!-- RIGHT COLUMN: Viewing, deleting and updating orderables -->
        <div class="col-lg-6">

        @component('admin.shared.components.orderable-update-listing', ['orderables' => $orderables])
        @endcomponent


        </div>
    </div>

@endsection