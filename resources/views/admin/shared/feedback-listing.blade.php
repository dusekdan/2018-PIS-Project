@extends('admin.home')

@section('subpage-contents')
    <table class="table table-striped">
        <tr>
            <th style="width: 20%;">Kontakt na zákazníka</th>
            <th style="width: 80%;">Text zpětné vazby</th>
        </tr>
        @foreach($feedback as $record)
            <tr>
                <td>{{ $record->contact }}</td>
                <td>{{ $record->text }}</td>
            </tr>
        @endforeach
    </table>

    {{$feedback->links()}}
@endsection