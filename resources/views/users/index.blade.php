@extends('layouts.app');
@section('content')
<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="">
            <tr class="text-center table-info">
                <th scope="col">Name</th>
                <th scope="col">email</th>
                <th scope="col">verify status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>
                    {{ $user->name }}
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    {{ isset($user->email_verified_at)?'verified' : 'not verified' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection