@extends('layouts.app')

<div class="col">

    @section('content')
    {{$dataTable->table(['class' => 'table table-bordered text-center'])}}
    @endsection
</div>
@push('scripts')
    {{$dataTable->scripts()}}
@endpush