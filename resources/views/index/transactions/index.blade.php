@extends('index.layouts.app')

@section('content')
    <ul class="list-group">
        @foreach ($transactions as $transaction)
        <li class="list-group-item @if ($transaction->transaction < 0)
            text-white bg-gradient-danger
        @else text-white bg-gradient-success
        @endif">
            {{ floatval($transaction->transaction) }} 
        </li>
        @endforeach
    </ul>
@endsection