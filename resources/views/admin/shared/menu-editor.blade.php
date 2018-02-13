@extends('admin.home')

@section('subpage-contents')
    <div class="row">
        <!-- LEFT COLUMN: Adding Menu -->
        <div class="col-lg-6" style="border-right: 1px solid lightgray">

            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <h5 class="alert-heading">Vytvoření menu se nezdařilo!</h5>
                    {{ \Session::get('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5 class="alert-heading">Vytvoření menu se nezdařilo!</h5>
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

            <h4>Vytvořit menu</h4>
            <script>
                var dateFormatForDatepickers = 'dd. mm. yy'
                $(function () {
                    $("#menu-validity-start").datepicker({
                        beforeShow: function (input, inst) {
                            setTimeout(function () {
                                inst.dpDiv.css({
                                    top: $("#menu-validity-start").offset().top + 35,
                                    left: $("#menu-validity-start").offset().left
                                });
                            }, 0);
                        },
                        dateFormat: dateFormatForDatepickers
                    })
                });
                $(function () {
                    $("#menu-validity-end").datepicker({
                        beforeShow: function (input, inst) {
                            setTimeout(function () {
                                inst.dpDiv.css({
                                    top: $("#menu-validity-end").offset().top + 35,
                                    left: $("#menu-validity-end").offset().left
                                });
                            }, 0);
                        },
                        dateFormat: dateFormatForDatepickers
                    })
                });
            </script>

            <form method="post" action="{{route('admin.menu-editor')}}">

                <div class="form-group">
                    <label for="menu-validity-start" class="required">Začátek platnosti:</label>
                    <input
                            type="text"
                            id="menu-validity-start"
                            name="menu-validity-start"
                            title="menu-validity-start"
                            class="form-control"
                            required="required"
                            value="{{old('menu-validity-start')}}"
                            onchange="tryPrefillingMenuName()"
                    >
                </div>

                <div class="form-group">
                    <label for="menu-validity-end" class="required">Konec platnosti:</label>
                    <input
                            type="text"
                            id="menu-validity-end"
                            name="menu-validity-end"
                            title="menu-validity-end"
                            class="form-control"
                            required="required"
                            value="{{old('menu-validity-end')}}"
                            onchange="tryPrefillingMenuName()"
                    >
                </div>

                <div class="form-group">
                    <label for="menu-name" class="required">Název</label>
                    <input
                            type="text"
                            id="menu-name"
                            name="menu-name"
                            title="menu-name"
                            class="form-control"
                            required="required"
                            value="{{old('menu-name')}}"
                    >
                </div>

                <div class="form-group">
                    <label for="menu-soup" class="required">Polévka</label>
                    <select
                            type="text"
                            id="menu-soup"
                            name="menu-soup"
                            title="menu-soup"
                            class="form-control"
                            required="required"
                    >
                        <option value="-1">Vyberte prosím</option>
                        @foreach($orderables as $orderable)
                            @if ($orderable->orderable_type->name == 'Polévka')
                                <option value="{{$orderable->id}}" {{  empty(old('menu-soup')) ? "" : (old('menu-soup') == $orderable->id) ? "selected=\"selected\"": ""}}>{{$orderable->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="menu-meal-1" class="required">Jídlo 1:</label>
                    <select
                            type="text"
                            id="menu-meal-1"
                            name="menu-meal-1"
                            title="menu-meal-1"
                            class="form-control"
                            required="required"
                    >
                        <option value="-1">Vyberte prosím</option>
                        @foreach($orderables as $orderable)
                            @if ($orderable->orderable_type->name != 'Polévka' && $orderable->orderable_type->name != 'Pití')
                                <option value="{{$orderable->id}}" {{  empty(old('menu-meal-1')) ? "" : (old('menu-meal-1') == $orderable->id) ? "selected=\"selected\"": ""}}>{{$orderable->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="menu-meal-2">Jídlo 2:</label>
                    <select
                            type="text"
                            id="menu-meal-2"
                            name="menu-meal-2"
                            title="menu-meal-2"
                            class="form-control"
                            required="required"
                    >
                        <option value="-1">Vyberte prosím</option>
                        @foreach($orderables as $orderable)
                            @if ($orderable->orderable_type->name != 'Polévka' && $orderable->orderable_type->name != 'Pití')
                                <option value="{{$orderable->id}}" {{  empty(old('menu-meal-2')) ? "" : (old('menu-meal-2') == $orderable->id) ? "selected=\"selected\"": ""}}>{{$orderable->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="menu-meal-3">Jídlo 3:</label>
                    <select
                            type="text"
                            id="menu-meal-3"
                            name="menu-meal-3"
                            title="menu-meal-3"
                            class="form-control"
                    >
                        <option  value="-1">Vyberte prosím</option>
                        @foreach($orderables as $orderable)
                            @if ($orderable->orderable_type->name != 'Polévka' && $orderable->orderable_type->name != 'Pití')
                                <option value="{{$orderable->id}}" {{  empty(old('menu-meal-3')) ? "" : (old('menu-meal-3') == $orderable->id) ? "selected=\"selected\"": ""}}>{{$orderable->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{ csrf_field() }}

                <div class="form-group">
                    <input type="submit" value="Vytvořit menu" class="btn btn-primary">
                </div>
            </form>
        </div>


        <!-- LEFT COLUMN: current & past menus -->
        <div class="col-lg-6">
            @component('admin.shared.components.menu-update-listing', ['upcomingMenus' => $upcomingMenus, 'pastMenus' => $pastMenus])
            @endcomponent
        </div>

    </div>

@endsection

