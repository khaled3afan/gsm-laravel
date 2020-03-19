@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Gift Cards
    </div>
    <div class="card-body">
        <form class="form-inline mb-4" action="{{ route('giftcards.store')  }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="card" placeholder="كود البطاقة" class="form-control ml-3" value="{{ $card_code }}">
            </div>
            <div class="form-group">
                <input type="number" name="value" placeholder="القيمة" class="form-control ml-3" value="10" step="any" min="0.50">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success ml-3"><i class="fas fa-plus-circle" aria-hidden="true"></i> الإضافة
                </button>
            </div>
        </form>

        <h5 class="card-title">Gift Cards</h5>
        
        <div>
            <table class="table table-bordered">
                <thead class="">
                    <tr class="text-center table-info">
                        <th scope="col">card code</th>
                        <th scope="col">value</th>
                        <th scope="col">status</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($giftcards as $giftcard)
                    <tr>
                        <td>
                            {{ $giftcard->card }}
                        </td>
                        <td>
                            <span class="text-success font-dubai-bold">$</span>{{ $giftcard->value }}
                        </td>
                        <td {{ $giftcard->status ? 'class=text-danger' : 'class=text-success' }}>
                            {{ $giftcard->status ? 'used' : 'New' }}
                        </td>
                        <td class=" text-center">
                            <form action="{{ route('giftcards.destroy', $giftcard->id) }}" method="POST" class="d-inline-block m-1 p-0">
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
    </div>
</div>
@endsection