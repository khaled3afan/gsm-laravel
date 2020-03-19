@extends('layouts.app')
@section('content')

    <form action="{{ route('servicecodes.store') }}" method="POST">
        {{ isset($service) ?$service->title : ''}}
        @isset($bundle)
            {{ $bundle->service->title }}
            <br>
            {{ $bundle->name }}
        @endisset
        @csrf
        <div class="form-group">
          <label for="codes">Codes</label>
          <textarea class="form-control" name="codes" id="codes" rows="6"></textarea>
        </div>
        @if (isset($bundles) && count($bundles))
            <div class="form-group">
                <label for="exampleFormControlSelect1">Bundle Group</label>
                <select name="bundle_id" class="form-control" id="exampleFormControlSelect1">
                    <option value="3">he</option>
                    @foreach ($bundles as $bundle)
                        @if ($bundle->bundletype->name == 'instant')
                            <option value="{{ $bundle->id }}">{{ $bundle->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        @endif
        <div class="form-group">
        @isset($service)
            <input type="hidden" name="service_id" value="{{ $service->id }}">
        @endisset   

        @isset($bundle)
            <input type="hidden" name="bundle_id" value="{{ $bundle->id }}">
        @endisset   
        </div>
        <div class="form-group">
            <button type="submit" class="px-4 btn btn-success">
                Add
            </button>
        </div>
    </form>
@endsection