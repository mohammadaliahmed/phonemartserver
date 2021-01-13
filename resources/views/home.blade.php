@extends('layouts.app')


@section('content')
    <div class="container">
        <hr>
        <h2>
            Brands
        </h2>
        <hr>
        <div class="row margin10border">
            @foreach ($categories as $category)
                <div class="col-3 col-lg-2">

                    <center>
                        <a href="category/{{$category->category}}"
                           data-toggle="tooltip"
                           title="{{$category->category}}">
                            <div class="border">
                                <img src="public/categories/{{$category->image}}" height="70" width="70">
                                <p>

                            </div>

                        </a>
                    </center>

                    <br>
                </div>

            @endforeach

        </div>

        <br>

        <hr>
        <h2>
            New Ads
        </h2>
        <hr>

        <div class="row">

            @foreach ($ads as $ad)
                <div class="col-6 col-lg-3">
                    <a href="viewad/{{$ad->id}}"
                       data-toggle="tooltip"
                       title="Show Details">
                        <div class="p-3 border bg-light">
                            <img src="{{$ad->img}}" height="180" width="180">
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
