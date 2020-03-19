@extends('index.layouts.app')

@section('content')
    <div class="row my-4">
        <div class="col">
            <h2 class="text-center">
                {{ $category->name }}
            </h2>
            <div class="row mt-4 pr-2">
                <div class="col">
                    <div class="row">
                        @foreach ($services as $service)
                            <div class="col col-sm-6 mx-sm-auto col-md-4 mx-md-0 mb-3">
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
                                    <a href="{{ route('index.service.show', $service->id) }}" class="btn btn-primary mx-0 font-weight-bold float-left">buy</a>
                                    <span class="badge badge-warning p-2 float-right mt-2">${{ number_format($service->price, 2) }}</span>

                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 bg-gradient-warning">
        </div>
    </div>
@endsection