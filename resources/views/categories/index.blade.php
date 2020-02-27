@extends('layouts.app')
@section('content')
<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="">
            <tr class="text-center table-info">
                <th scope="col">Name</th>
                <th scope="col">Services count</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>
                    {{ $category->name }}
                </td>
                <td>
                    {{ $category->services->count() }}
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