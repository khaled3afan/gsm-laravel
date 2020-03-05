@extends('index.layouts.app')
@section('content')
<div class="row">

    <div class="col-md-8">
    <img class="img-fluid mx-auto rounded d-block" src="https://picsum.photos/400/200" alt="">
        <div class="container mt-3">
            <h2>
                {{ $service->title }}
            </h2>
            <b>
                {{ $service->description }}
            </b>
            <p>
                {{ $service->content }}
            </p>
        </div>
    </div>
    <div class="col text-center">

        <form action="" method="post" class="text-left">
            @csrf
            <input type="hidden" value="{{ $service->id }}" name="service_id">
        @if ($service->bundles->count())
            @php
                $bundles = $service->bundles;
            @endphp
        <div class="form-group">

            <label for="bundel">select package</label>
            <select id="bundel" class="form-control" name="bundle_id" >
                    <option value="" disabled selected>Select a package</option>
                @foreach ($bundles as $bundle)
                    @if ( $bundle->bundletype->name == 'instant' && $bundle->bundle_codes->count())

                        <option value="{{ $bundle->id }}"> {{ $bundle->name }}
                        <b class="badge badge-success bg-danger">instant</b>
                        </option>
                    @elseif($bundle->bundletype->name != 'instant')
                        <option value="{{ $bundle->id }}">
                            {{ $bundle->name }}
                        </option>
                    @endif
                @endforeach
                
            </select>
        </div>
        @endif
        
        @isset($service->accept_info)
        <div class="form-group">
            <label for="info">{{ $service->info_label ?? '' }}</label>
            <textarea id="info" class="form-control" name="info" rows="2" placeholder="{{ $service->info_placeholder ?? '' }}" {{ isset($bundles) ? '' : 'required' }}></textarea>
        </div>
        @endisset
        <div class="form-group text-center">
            <input type="submit" class="btn btn-success" value="Request Now">
        </div>
    </form>
</div>
</div>
@endsection