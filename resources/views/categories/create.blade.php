@extends('layouts.app')
@section('content')
@if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        .<div class="form-group">
          <label for="name">Category Title</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="enter title" aria-describedby="helpId">
          <small id="helpId" class="text-muted">enter category name</small>
        </div>
        <div class="form-group">
            <button type="submit" class="px-4 btn btn-success">
                Add
            </button>
        </div>
    </form>
@endsection