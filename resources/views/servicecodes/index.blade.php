@extends('layouts.app');

@section('content')

        <div class="table-responsive">
            <a class="btn btn-success" href="" role="button">add new codes</a>
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <th scope="col">code</th>
                        <th scope="col">Status</th>
                        <th scope="col">service</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($codes as $code)
                    <tr>
                        <td>
                            {{ $code->code }}
                        </td>
                        <td>
                            @if ($code->status == 'unpaid')
                                unpaid
                            @else
                                paid
                            @endif
                        </td>
                        <td>
                            {{ $code->service->title }}
                        </td>
                        <td>
                            {{ $code->bundle->name }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection