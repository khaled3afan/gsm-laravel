@extends('index.layouts.app')

@section('content')

    @foreach ($orders as $order)
        {!! $order->title !!} <hr>
    @endforeach
    <div class="d-flex text-center justify-content-center">
        {{ $orders->onEachSide(5)->links() }}
    </div>
@endsection