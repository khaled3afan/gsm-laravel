@extends('index.layouts.app')

@section('content')
<div class="row mb-md-4">
    <div class="col-md-6">
        <div class="card h-100 m-auto">

            <div class="card-header text-center">
                Add Balance
            </div>
            <div class="card-body">
                <form class="form-inline my-2 px-0" action="{{ route('index.add_balance')  }}" method="POST">
                    @csrf
                    <div class="form-group mx-auto px-0">
                        <input type="text" name="card" placeholder="كود البطاقة" class="form-control ml-3" autocomplete="off">
                    </div>
                    <div class="form-group mx-auto">
                        <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle" aria-hidden="true"></i> الإضافة
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100 justify-content-center">
            <div class="card-header text-center">
                Your Balance
            </div>
            <H2 class="text-center text-muted" style="font-size:70px">
                <span class="text-success" style="font-size:80px">$</span>{{ Auth::user()->wallet->balance }}
            </H2>
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Transactions History
            </div>
    
            <div class="card-body p-0">
                <table class="table table-bordered text-center m-0">
                    <thead class="table-info">
                        <tr>
                            <th>transaction</th>
                            <th>balance after</th>
                            <th>info</th>
                            <th>notes</th>
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
                            <td>
                                {{ $transaction->note }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    
            <div class="card-footer justify-content-center py-1">
                <div class="row justify-content-center">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection