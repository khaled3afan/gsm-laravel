@extends('layouts.app');

@section('content')

        <div class="table-responsive">
            <a class="btn btn-success" href="" role="button">add new codes</a>
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <th scope="col">Bondle Name</th>
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
                            {{ $bundle->price }}
                        </td>
                        <td>
                            {{ $bundle->service->title }}
                        </td>
                        <td>
                            actions
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection