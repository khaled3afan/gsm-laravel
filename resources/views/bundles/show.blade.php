@extends('layouts.app')
@section('content')
    {{ $bundle->name }}
    <div class="table-responsive">
        <a class="btn btn-success" href="{{ route('bundlecodes.create', $bundle->id) }}" role="button">add new codes</a>
        <table class="table table-bordered">
            <thead class="bg-primary text-white">
                <tr class="text-center">
                    <th scope="col">code</th>
                    <th scope="col">Status</th>
                    <th scope="col">service</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bundle->bundle_codes as $code)
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
                        {{ $bundle->service->title }}
                    </td>
                    <td>
                        Action
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection