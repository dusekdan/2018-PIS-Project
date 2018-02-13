@extends('public.app')

@section('content')

    <!-- Storno formulář -->
    <div class="container text-center" id="stornoForm">
        <h3>Stornovat rezervaci</h3>


        @if (\Session::has('success'))
            <div class="alert alert-success">
                {{\Session::get('success')}}
            </div>
        @endif

        @if (\Session::has('error'))
            <div class="alert alert-danger">
                {{\Session::get('error')}}
            </div>
        @endif


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form method="post" action="{{route('public.storno')}}">

            <div class="row">
                <div class="form-group col-md-12">
                    <p>Chcete-li stornovat rezervaci, vložte prosím klíč,
                        který jste obdrželi v potvrzovacím emailu do následujícího políčka:</p>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <input
                            placeholder="Rezervační klíč *"
                            type="text"
                            id="key"
                            name="key"
                            title="key"
                            class="form-control required"
                            required="required"
                            value="{{old('key')}}"
                    />
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <input type="submit" class="btn button" value="Stornovat rezervaci">
                </div>
            </div>

            {{ csrf_field()  }}
        </form>

    </div>



@endsection