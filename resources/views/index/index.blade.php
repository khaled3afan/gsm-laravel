@extends('index.layouts.app')

@section('content')
<div class="container mb-5 p-0 pb-5">

    <div class="row m-2 bg-success p-0" style="border-bottom:1px solid #333">
        <div class="col-lg-5 bg-warning">
            <div id="carouselExampleIndicators" class="carousel slide p-0" data-ride="carousel">
                <ol class="carousel-indicators">
                        @for ($i = 0; $i < 5; $i++)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"></li>
                    @endfor
                </ol>
                <div class="carousel-inner">
                    @php
                        $active = 'active';
                    @endphp
                    @foreach ($carousel as $service)
                        <div class="carousel-item {{ $active }}">
                            <img class="d-block m-auto" src="{{ asset('storage/'. $service->image) }}" alt="..." max-height="300px">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $service->title }}</h5>
                                <p>{{ $service->description }}</p>
                            </div>
                        </div>
                        @php
                            $active = '';   
                        @endphp
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>


    <div class="row m-0">
        <div class="col m-2">
 
            @foreach($categories as $category)
                @if ($category->services->count())
                    <div class="row mb-4 py-4 bg-light rounded">
                        <div class="col">
                            
                            <h2>
                                {{ $category->name }}
                            </h2>
                            <div class="row">
                                @foreach ($category->services as $service)
                                    <div class="col col-sm-6 mx-sm-auto col-md-6 mx-md-0 mb-3">
                                        <div class="card h-100">
                                        {{-- <img src="{{ asset('storage/'. $service->image) }}" alt="image of service" title="{{ $service->title }}" class="card-img"> --}}
                                            <img src="https://picsum.photos/400/200?random={{ $service->id }}" alt="" class="card-img">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                {{ $service->title }}
                                            </h4>
                                            <p class="card-text text-truncate">
                                                {{ $service->description }}
                                            </p>
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{ route('index.service.show', $service->id) }}" class="btn btn-primary mx-0 px-4 font-dubai-light float-left"> شراء</a>
                                            <span class="badge badge-warning p-2" style="font-size:12px">${{ number_format($service->price, 2) }}</span>

                                        </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif  
            @endforeach
        </div>
        <div class="col-3 m-2 bg-light">
        </div>
    </div>
</div>  
@endsection