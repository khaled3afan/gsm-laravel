@extends('layouts.app');
@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">services</div>
        <div>
            <a href="{{ route('services.create') }}" class="btn btn-outline-success btn-lg m-2">Add New Service</a>
        </div>
        <div class="card-body">

            <table class="table table-hover table-bordered table-responsive">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">description</th>
                    <th scope="col">actions</th>
                  </tr>
                </thead>
                <tbody>
                @if ($services->count() > 0)
                    @php
                        $counter= 0;
                    @endphp
                    @foreach ($services as $service)
                    @php
                        $counter++;
                    @endphp
                        <tr>
                            <th scope="row">{{ $counter }}</th>
                            <td>{{ $service->title }}</td>
                            <td>{{ $service->description }}</td>
                            <td class="text-nowrap text-center">
                                @if (isset($service->servicetype) && $service->servicetype->name=='instant')
                                <a href="{{ route('servicecodes.create', $service->id) }}" class="btn btn-success  m-1"> <i class="fas fa-gift"></i></a>
                                @endif

                                <a href="{{ route('bundles.create', $service->id) }}" class="btn btn-secondary  m-1"> <i class="fas fa-box-open"></i></a>

                                <a href="{{ route('services.show', $service->id) }}" class="btn btn-info  m-1 text-white"> <i class="fas fa-eye"></i></a>
                                <br class="d-md-none">
                                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary  m-1"> <i class="fas fa-edit"></i></a>

                                <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline-block m-1 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" style="cursor:pointer"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td scop="row" colspan="3" class="text-center">
                        there's no services yet
                    </td>
                </tr>
                @endif
                </tbody>
              </table>



{{-- 
            @if ($services->count() > 0)
            <ul class="list-group">
                @foreach ($services as $service)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col d-flex">
                                {{ $service->title }}
                            </div>
                            <div class="col d-flex align-items-center">
                                    @if (isset($service->servicetype) && $service->servicetype->name=='instant')
                                          <a href="{{ route('servicecodes.create', $service->id) }}" class="btn btn-success btn-md"> <i class="fas fa-gift"></i></a>
                                    @endif
                                  
                                    <a href="{{ route('bundles.create', $service->id) }}" class="btn btn-success btn-md"> <i class="fas fa-plus"></i></a>

                                    <a href="{{ route('services.show', $service->id) }}" class="btn btn-success btn-md"> <i class="fas fa-eye"></i></a>
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary btn-md"> <i class="fas fa-edit"></i></a>

                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="btn btn-danger btn-md">
                                        @csrf
                                        @method('DELETE')
                                        <button class=""><i class="fas fa-trash"></i></button>
                                    </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            @else
            <div class="alert alert-primary">
                there's no content yet
            </div>
            @endif --}}
        </div>
    </div>
@endsection