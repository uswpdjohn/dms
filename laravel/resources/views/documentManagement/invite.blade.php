@extends('layouts.master')
@section('content')
    <div>
        <form action="{{route('invite', $document)}}" method="POST" >
            @csrf
            <label for="">Shareholder:</label>

            @foreach($shareholder as $item)
                <label for="">{{$item->email}}</label>
                <input type="checkbox" name="shareholder[]" value="{{$item->id}}">
            @endforeach
                <br>
            <label for="">Director:</label>

            @foreach($director as $item)
                <label for="">{{$item->email}}</label>
                <input type="checkbox" name="director[]" value="{{$item->id}}">
            @endforeach

            <div>
                <button type="submit">Submit</button>
            </div>

        </form>
    </div>

@endsection
