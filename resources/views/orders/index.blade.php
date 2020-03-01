@extends('layouts.app');

@section('content')

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <th scope="col">order title</th>
                        <th scope="col">Info</th>
                        <th scope="col">Price</th>
                        <th scope="col">user</th>
                        <th scope="col">status</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>
                            {!! $order->title !!}
                        </td>
                        <td>
                            {{ $order->info }}
                        </td>
                        <td>
                            ${{ $order->price }}
                        </td>
                        <td>
                            {{ $order->user->name }}
                        </td>
                        <td>
                            {{ $order->status ? 'done' : 'waiting' }}
                        </td>
                        <td>
                            <a href="{{ route('bundlecodes.create', $order->id) }}" class="btn btn-success  m-1 text-white"> <i class="fas fa-plus"></i></a>
                            <a href="{{ route('bundles.show', $order->id) }}" class="btn btn-info  m-1 text-white"> <i class="fas fa-eye"></i></a>
                            <form action="{{ route('bundles.destroy', $order->id) }}" method="POST" class="d-inline-block m-1 p-0">
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