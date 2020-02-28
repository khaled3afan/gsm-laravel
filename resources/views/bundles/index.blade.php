@extends('layouts.app');

@section('content')

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <th scope="col">Bondle Name</th>
                        <th scope="col">codes count</th>
                        <th scope="col">Price</th>
                        <th scope="col">service</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bundles as $bundle)
                    <tr>
                        <td>
                            {{ $bundle->name }}
                        </td>
                        <td>
                            {{ $bundle->bundle_codes->count() }}
                        </td>
                        <td>
                            ${{ $bundle->price }}
                        </td>
                        <td>
                            {{ $bundle->service->title }}
                        </td>
                        <td>
                            <a href="{{ route('bundlecodes.create', $bundle->id) }}" class="btn btn-success  m-1 text-white"> <i class="fas fa-plus"></i></a>
                            <a href="{{ route('bundles.show', $bundle->id) }}" class="btn btn-info  m-1 text-white"> <i class="fas fa-eye"></i></a>
                            <form action="{{ route('bundles.destroy', $bundle->id) }}" method="POST" class="d-inline-block m-1 p-0">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" style="cursor:pointer"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection