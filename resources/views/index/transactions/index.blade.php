@extends('index.layouts.app')

@section('content')
    <table class="table table-light">
        <thead>
            <tr>
                <th>transaction</th>
                <th>balance after</th>
                <th>info</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td @if ($transaction->transaction > 0)
                    class="text-success"
                @else
                    class="text-danger"
                @endif>
                    @if ($transaction->transaction > 0)
                        +
                    @endif
                    {{ $transaction->transaction }}
                </td>
                <td>
                    {{ $transaction->balance_after }}
                </td>
                <td>
                    {{ $transaction->info }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection