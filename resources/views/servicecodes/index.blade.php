@extends('layouts.app')

@section('content')

        <div class="table-responsive">
            <a class="btn btn-success" href="" role="button">add new codes</a>
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <th scope="col">code</th>
                        <th scope="col">Status</th>
                        <th scope="col">service</th>
                        <th scope="col">Bundle Name</th>
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
                            @if ($code->service_id)
                                {{ $code->service->title }}
                            @else
                                {{ $code->bundle->service->title }}
                            @endif
                        </td>
                        <td>
                            {{ isset($code->bundle_id) ? $code->bundle->name : 'no bundle set' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection