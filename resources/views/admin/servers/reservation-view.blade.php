@extends('admin.home')
@section('subpage-contents')
    <div class="tab-content">

        <ul class="nav nav-tabs">
            <li class="nav-item active"><a class="nav-link active" data-toggle="tab" href="#waiting">Aktuální rezervace</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#history">Historie rezervací</a></li>
        </ul>

        <br>

        <div id="waiting" class="tab-pane fade in active show">

            <div class="alert alert-info">
                V této sekci jsou zobrazeny <strong>rezervace čekající na potvrzení</strong> a potvrzené/zamítnuté rezervace <strong>na dnešní a nadcházející dny</strong>.
            </div>


            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <h5 class="alert-heading">Úprava menu se nezdařila!</h5>
                    {{ \Session::get('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5 class="alert-heading">Úprava menu se nezdařila!</h5>
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



            @if ($pending->isNotEmpty())
                <h4>Rezervace čekající na potvrzení</h4>
            @endif
            @foreach ($pending as $reservation)

                <div class="card" style="margin-top: 25px; margin-bottom: 25px;">
                    <div class="card-header">
                        Rezervace na (od <strong>{{$reservation->reservation_start_time}}</strong> do <strong>{{$reservation->reservation_end_time}}</strong>)
                        <div class="row" style="float: right;margin-right: -50px;">
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title"><strong>Kontakt:</strong> {{ $reservation->customer_email }}</h6>
                        <h6 class="card-title"><strong>Počet rezervovaných míst:</strong> {{ $reservation->number_of_people}}</h6>
                        <p class="card-text"><strong>Poznámka:</strong> {{$reservation->note}}</p>
                    </div>
                </div>

            @endforeach

            <h4>Dnešní a nadcházející rezervace</h4>
            @foreach ($upcoming as $reservation)

                <div class="card" style="margin-top: 25px; margin-bottom: 25px;">
                    <div class="card-header">
                        Rezervace na (od <strong>{{$reservation->reservation_start_time}}</strong> do <strong>{{$reservation->reservation_end_time}}</strong>)
                        <div class="row" style="float: right;">
                            <div class="col-lg-4">
                                @if ($reservation->status == 'Zamítnuta')
                                    <h4><span class="badge badge-secondary">{{$reservation->status}}</span></h4>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title"><strong>Kontakt:</strong> {{ $reservation->customer_email }}</h6>
                        <h6 class="card-title"><strong>Počet rezervovaných míst:</strong> {{ $reservation->number_of_people}}</h6>
                        <p class="card-text"><strong>Poznámka:</strong> {{$reservation->note}}</p>
                    </div>
                </div>

            @endforeach

        </div>
        <!-- HISTORY TAB -->
        <div id="history" class="tab-pane fade">
            <div class="alert alert-info">
                Pod touto kartou je k nalezení kompletní historie provedených rezervací z rezervačního formuláře. Zamítnuté, potvrzené i stornované rezervace.
            </div>

            <h4>Historické rezervace</h4>

            @foreach ($history as $reservation)

                <div class="card" style="margin-top: 25px; margin-bottom: 25px;">
                    <div class="card-header">
                        Rezervace na (od <strong>{{$reservation->reservation_start_time}}</strong> do <strong>{{$reservation->reservation_end_time}}</strong>)
                        <div class="row" style="float: right">
                            <h4><span class="badge badge-secondary">{{$reservation->status}}</span></h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title"><strong>Kontakt:</strong> {{ $reservation->customer_email }}</h6>
                        <h6 class="card-title"><strong>Počet rezervovaných míst:</strong> {{ $reservation->number_of_people}}</h6>
                        <p class="card-text"><strong>Poznámka:</strong> {{$reservation->note}}</p>
                    </div>
                </div>

            @endforeach
        </div>

    </div>



@endsection