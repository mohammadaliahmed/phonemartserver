@extends('layouts.app')


@section('content')
    <div class="container">

        <br>
        <h2>
            Showing {{$category}} ads
        </h2>
        <div class="row">

            @foreach ($ads as $ad)
                <div class="col-md-3">
                    <a href="../viewad/{{$ad->id}}"
                       data-toggle="tooltip"
                       title="Show Details">
                        <div class="p-3 border bg-light">
                            <img src="{{$ad->img}}" height="200" width="200">
                            <p>
                            <h3><b>Rs{{$ad->price}}</b></h3></p>
                            <p>{{$ad->title}}</p>
                            {{--<span>{{$ad->city}}</span> &emsp; &emsp;&emsp; <span>  {{$ad->time}}</span>--}}
                            <p style="font-size:11px">{{$ad->city}}&emsp; &emsp;&emsp; {{$ad->time}}</p>

                        </div>
                    </a>
                    <br> <br>

                </div>

            @endforeach

        </div>


    </div>

@endsection
