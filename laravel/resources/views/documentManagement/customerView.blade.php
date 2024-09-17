@extends('layouts.master')
@section('content')
{{--    <embed src="{{$link}}#toolbar=0" style="width:600px; height:500px;">--}}
{{--    <iframe src="{{$link}}" title="W3Schools Free Online Web Tutorials"></iframe>--}}
    <form action="{{route('download.document')}}" method="POST">
        @csrf
        @foreach($document as $year=>$months)
            <div>


           <label for="" style="background-color: cornflowerblue">{{$year}}</label>
               @foreach($months as $key=>$value)
{{--                   @if(key_exists('01',$months) )--}}
                   @if($key=='01')
                       <label for="">Mar</label>
                       @foreach($value as $i)
                            <label for="">{{$i['name']}}</label>
                            <input type="checkbox" name="document_id[]" value="{{$i['document_id']}}">
                       @endforeach
                   @elseif($key=='02')
                       <label for="">Feb</label>
                       @foreach($value as $i)
                           <label for="">{{$i['name']}}</label>
                       @endforeach
                   @elseif($key=='03')
                       <label for="">Mar</label>
                       @foreach($value as $i)
                           <label for="">{{$i['name']}}</label>
                            <input type="checkbox" name="document_id[]" value="{{$i['document_id']}}">
                       @endforeach
                   @elseif($key=='04')
                       <label for="">Apr</label>
                       @foreach($value as $i)
                           <label for="">{{$i['name']}}</label>
                       @endforeach
                   @elseif($key=='05')
                       <label for="">May</label>
                       @foreach($value as $i)
                           <label for="">{{$i['name']}}</label>
                       @endforeach
                   @elseif($key=='06')
                       <label for="">Jun</label>
                       @foreach($value as $i)
                           <label for="">{{$i['name']}}</label>
                       @endforeach
                   @elseif($key=='07')
                       <label for="">Jul</label>
                       @foreach($value as $i)
                           <label for="">{{$i['name']}}</label>
                       @endforeach
                   @elseif($key=='08')
                       <label for="">Aug</label>
                       @foreach($value as $i)
                           <label for="">{{$i['name']}}</label>
                       @endforeach
                   @elseif($key=='09')
                       <label for="">Sep</label>
                       @foreach($value as $i)
                           <label for="">{{$i['name']}}</label>
                            <input type="checkbox" name="document_id[]" value="{{$i['document_id']}}">
                       @endforeach
                   @elseif($key=='10')
                       <label for="">Oct</label>
                       @foreach($value as $i)
                           <label for="">{{$i['name']}}</label>
                       @endforeach
                   @elseif($key=='11')
                       <label for="">Nov</label>
                       @foreach($value as $i)
                           <label for="">{{$i['name']}}</label>
                       @endforeach
                   @elseif($key=='12')
                       <label for="">Dec</label>
                       @foreach($value as $i)
                           <label for="">{{$i['name']}}</label>
                       @endforeach
                   @endif
        {{--           @dd($month)--}}
        {{--               <input type="checkbox">--}}
        {{--               <label for="">{{$i->name}}</label>--}}

               @endforeach



       </div>
        @endforeach
        <button type="submit">Download</button>
    </form>


@endsection
