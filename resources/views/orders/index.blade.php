@extends('layouts.app')

<div class="col">

    @section('content')
    {{$dataTable->table()}}
    @endsection
</div>
@push('scripts')
    {{$dataTable->scripts()}}
@endpush