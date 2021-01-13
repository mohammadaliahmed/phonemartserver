@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">


            <div class="col-12 col-lg-8">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">


                        <div class="carousel-item active">
                            <div class="border">

                                <img class="d-block" width="100%" height="500"
                                     src="{{$images[0]}}"
                                     alt="First slide">
                            </div>
                        </div>
                        @foreach ($images as $image)
                            <div class="carousel-item">
                                <div class="border">
                                    <img class="d-block" width="100%" height="500"
                                         src="{{$image}}"
                                         alt="Second slide">
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>
            </div>
            <div class="col-lg-4 col-6 ">

                <div class="border  p-2">
                    <h3>
                        Rs {{$ad->price}}
                    </h3>
                    <p><h6> {{$ad->title}}</h6></p>
                    <p> {{$ad->area}}, {{$ad->city}} &emsp;&emsp;&emsp;{{$ad->time}}</p>
                </div>
                <br>

                <div class="border p-2">
                    <a href="/adsByUser/{{$ad->user_id}}">
                        <h4>
                            Ad By {{$user->name}}
                        </h4>
                    </a>
                    <p>
                        <svg width="26px" height="26px" viewBox="0 0 1024 1024" data-aut-id="icon" class=""
                             fill-rule="evenodd">
                            <path class="rui-367TP"
                                  d="M302.933 196.267l55.467 85.333 51.2 76.8-72.533 98.133c28.233 48.749 60.76 90.785 98.112 127.979l0.021 0.021c36.027 37.289 76.655 69.772 121.064 96.635l2.669 1.499 102.4-72.533 162.133 106.667-46.933 76.8c-3.967 8.705-11.743 15.077-21.139 17.033l-0.194 0.034c-13.201 5.713-28.574 9.035-44.723 9.035-3.783 0-7.523-0.182-11.213-0.539l0.469 0.037c-68.267 0-174.933-38.4-315.733-179.2s-196.267-307.2-174.933-375.467c3.317-8.951 9.267-16.279 16.901-21.232l0.166-0.101 76.8-46.933zM290.133 115.2l-102.4 59.733c-24.564 15.646-42.773 39.399-50.988 67.422l-0.212 0.844c-29.867 89.6-21.333 238.933 192 448q204.8 204.8 371.2 204.8l81.067-8.533c27.198-11.319 49.209-30.578 63.665-54.859l0.335-0.607 59.733-98.133-12.8-64-226.133-149.333-110.933 68.267-64-59.733-59.733-68.267 38.4-55.467 34.133-46.933-29.867-42.667-51.2-76.8-72.533-110.933z"></path>
                        </svg>
                        <b> {{$user->phone}}</b></p>
                </div>
                <br>
                <div class="border p-2">
                    <h4>Details</h4>
                    Brand: {{$ad->category}}
                </div>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12 margin10border">

                <h4>Description</h4>

                {{$ad->description}}
            </div>
        </div>
        <br>

        <h4>Related ads</h4>
        <div class="row">


            @foreach ($relatedAds as $relatedAd)
                <div class="col-lg-2 col-6">
                    <a href="{{$relatedAd->id}}"
                       data-toggle="tooltip"
                       title="Show Details">
                        <div class="p-3 border bg-light">
                            <img src="{{$relatedAd->img}}" height="100" width="100">
                            <p>
                                <b>Rs{{$relatedAd->price}}</b></p>
                            <p>{{$relatedAd->title}}</p>
                            <p style="font-size:11px">{{$relatedAd->city}}&emsp; &emsp;&emsp; {{$relatedAd->time}}</p>

                        </div>
                    </a>
                    <br> <br>

                </div>

            @endforeach


        </div>
    </div>




@endsection
