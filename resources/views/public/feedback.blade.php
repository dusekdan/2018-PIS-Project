@extends('public.app')

@section('content')

    <!-- Feedback form -->
    <div class="container text-center" id="feedbackForm">

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
        <h3>Poslat zpětnou vazbu</h3>

        <form method="post" action="{{route('public.feedback')}}">

            <div class="row">
                <div class="form-group col-md-12">
                    <!--<label class="control-label" for="contact" style="display:table">Kontakt na Vás: </label>-->
                    <input  placeholder="Vaše jméno / Váš telefon / Váš email *"
                            type="text"
                            id="contact"
                            name="contact"
                            title="contact"
                            class="form-control required"
                            required="required"
                            value="{{old('contact')}}"
                    >
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                <!--<label class="control-label" for="note" style="display:table">Text: </label>-->
                <textarea
                        placeholder="Obsah Vaší zpětné vazby *"
                        type="text"
                        id="note"
                        name="note"
                        rows="10"
                        title="note"
                        class="form-control required"
                        required="required"
                >{{old('note')}}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <input type="submit" class="btn button" value="Odeslat zpětnou vazbu">
                </div>
            </div>

            {{ csrf_field()  }}
        </form>


    </div>

@endsection