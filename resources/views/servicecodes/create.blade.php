@extends('layouts.app')
@section('content')
@if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
    <form action="{{ route('servicecodes.store') }}" method="POST">
        {{ isset($service) ?$service->title : ''}}
        @csrf
        <div class="form-group">
          <label for="codes">Codes</label>
          <textarea class="form-control" name="codes" id="codes" rows="6"></textarea>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Bundle Group</label>
            <select name="bundle_id" class="form-control" id="exampleFormControlSelect1">
              @foreach ($bundles as $bundle)
                  @if ($bundle->bundletype->name == 'instant')
                  <option value="{{ $bundle->id }}">{{ $bundle->name }}</option>
                  @endif
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