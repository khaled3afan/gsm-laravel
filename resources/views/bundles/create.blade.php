@extends('layouts.app')
@section('content')
@if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
    <form action="{{ route('bundles.store') }}" method="POST">
        {{ isset($service) ?$service->title : ''}}
        @csrf
        <div class="form-group">
            <label for="bundle-name">bundle name</label>
            <input id="bundle-name" class="form-control" type="text" name="name">
        </div>
        <div class="form-group">
            <label for="price">price</label>
            <input id="price" class="form-control" type="text" name="price">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Bundle type</label>
            <select name="bundletype_id" class="form-control" id="exampleFormControlSelect1">
              @foreach ($bundletypes as $bundletype)
            <option value="{{ $bundletype->id }}">{{ $bundletype->name }}</option>
              @endforeach
            </select>
        </div>

        <div class="form-group">
        <input type="hidden" name="service_id" value="{{ $service->id }}">
        </div>
        <div class="form-group">
            <button type="submit" class="px-4 btn btn-success">
                Add
            </button>
        </div>
    </form>
@endsection