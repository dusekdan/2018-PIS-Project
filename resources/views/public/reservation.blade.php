@extends('public.app')

@section('content')

    <!-- Rezervační formulář -->
    <div class="container text-center" id="reservationForm">
        <h3>Vytvořit novou rezervaci</h3>

        <script>
            var reservationDataEndPoint = window.location.href;

            var disableExisting = function(response)
            {
                if (response != undefined)
                {
                    $(".room-table").removeClass("disabled");
                    $(".room-saloon").removeClass("disabled");
                    $(".seat").removeClass("disabled");
                    for (var ii = 0; ii < response.length; ii++)
                    {
                        var res = response[ii];
                        console.log(res);
                        for (var i = 0; i < res.length; i++)
                        {
                            var obj = res[i];
                            $("#"+obj).addClass("disabled");
                            console.log(obj);
                        }
                    }
                    updateSelectedHiddenField();
                }
            }

            $(function(){
                $(".room-table").addClass("disabled");
                $(".room-saloon").addClass("disabled");
                $(".seat").addClass("disabled");
            });



            var dateFormatForDatepickers = 'dd. mm. yy';
            var from = 8;
            var to = 9;
            $(function () {
                $("#reservation-date").datepicker({
                    beforeShow: function (input, inst) {
                        setTimeout(function () {
                            inst.dpDiv.css({
                                top: $("#reservation-date").offset().top + 35,
                                left: $("#reservation-date").offset().left
                            });
                        }, 0);
                    },
                    onSelect: function (input, inst)
                    {
                        currentDate = input;
                        $.get(
                            reservationDataEndPoint + '/' + currentDate + '/' + from + '/' + to,
                            function(response){

                                disableExisting(response);
                            }
                        );
                    }
                    ,
                    dateFormat: dateFormatForDatepickers,
                    setDate: "+1d",
                    maxDate: "+3m",
                    minDate: new Date(),
                    monthNames: [ "Leden", "Únor", "Březen", "Duben", "Květen", "Červen", "Červenec", "Srpen",
                        "Září", "Říjen", "Listopad", "Prosinec" ],
                    nextText: "Později",
                    prevText: "Dříve",
                    dayNamesMin: [ "Po", "Út", "St", "Čt", "Pá", "So", "Ne" ],
                });
            });

            $(function() {
                $("#reservation-time-range").slider({
                    range: true,
                    min: 8,
                    max: 24,
                    values: [ 8, 9 ],
                    slide: function( event, ui ) {
                        $( "#time" ).val( ui.values[ 0 ] + ":00 - " + ui.values[ 1 ] + ":00" );
                        var data = { from : ui.values[0], to : ui.values[1]};
                    },
                    stop: function(event, ui)
                    {
                        from = ui.values[0];
                        to =  ui.values[1];
                        $.get(
                                reservationDataEndPoint + '/' + currentDate + '/' + from + '/' + to,
                            function(response){

                                disableExisting(response);
                            }
                        );
                    }
                });
                $("#time").val( $("#reservation-time-range").slider( "values", 0 )
                    + ":00 - " + $("#reservation-time-range").slider( "values", 1 ) + ":00" );
            } );
        </script>



        @if (\Session::has('error'))
            <div class="alert alert-danger">
                <h5 class="alert-heading">Rezervaci se nepodařilo vytvořit!</h5>
                {{ \Session::get('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <h5 class="alert-heading">Rezervaci se nepodařilo vytvořit!</h5>
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

        <form method="post" action="{{route('public.reservation')}}">

            <div class="row">
                    <div class="form-group col-md-5">
                        <label class="control-label" for="reservation-date" style="display:table">Datum rezervace: *</label>
                        <input  placeholder="Kliknutím vyberte datum"
                                type="text"
                                id="reservation-date"
                                name="reservation-date"
                                title="reservation-date"
                                class="form-control"
                                required="required"
                                value="{{old('reservation-date')}}"
                         />

                    </div>

                    <div class="form-group col-md-1"></div>

                    <div class="form-group col-md-5">

                        <label class="required" for="time" style="display:table">Čas rezervace: * </label>

                        <div class="" id="reservation-time-range" name="time"></div>

                        <input class="form-control date" type="text" id="time" name="time" readonly>

                    </div>
            </div>




            <div class="row">
            <div class="form-group col-md-12">
                <input
                        placeholder="Jméno *"
                        type="text"
                        id="customer-name"
                        name="customer-name"
                        title="customer-name"
                        class="form-control required"
                        required="required"
                />
            </div>
            </div>

            <div class="row">
            <div class="form-group col-md-12">

                <input
                        placeholder="E-mail *"
                        type="text"
                        id="customer-email"
                        name="customer-email"
                        title="customer-email"
                        class="form-control required"
                        required="required"
                        value="{{old('user-name')}}"
                />
            </div>

            </div>

            <div class="row info col-md-12">
                Vyberte jednotky k rezervaci.
                <br>
                Lze rezervovat samostatné židle nebo celý stůl, případně salonek.

            </div>

            <div class="row">
                @include('public.room-plan')
            </div>

            <div class="row">
                <div class="form-group col-md-12">

                    <textarea
                            placeholder="Poznámka"
                            type="text"
                            id="note"
                            name="note"
                            title="note"
                            class="form-control"
                            value="{{old('note')}}"
                    ></textarea>
                </div>

            </div>

            <input
                    type="hidden"
                    id="bookables"
                    name="bookables"
                    title="bookables"
                    class="form-control"
                    value="[]"
            />

            {{ csrf_field() }}
            <div class="form-group col-md-12">
                <input type="submit" class="btn button" value="Odeslat rezervaci">
            </div>

        </form>





    </div>


@endsection