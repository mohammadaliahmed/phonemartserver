@extends('layouts.app')


@section('content')
    <div class="container">

        <br>
        <h2>
            Showing {{$category}} ads
        </h2>
        <div class="row">

            @foreach ($ads as $ad)
                <div class="col-6 col-lg-3">

                    <a href="../viewad/{{$ad->id}}"
                       data-toggle="tooltip"
                       title="Show Details">
                        <div class="border bg-light">
                            <img src="{{$ad->img}}" height="150" width="150">
                            <div class="p-2">
                                <p>
                                    <b>Rs{{$ad->price}}</b></p>
                                <p>{{$ad->title}}</p>
                                {{--<span>{{$ad->city}}</span> &emsp; &emsp;&emsp; <span>  {{$ad->time}}</span>--}}
                                <p style="font-size:11px">{{$ad->city}}&emsp; &emsp;&emsp; {{$ad->time}}</p>

                            </div>
                        </div>
                    </a>
                    <br> <br>

                </div>

            @endforeach

        </div>


    </div>

@endsection
