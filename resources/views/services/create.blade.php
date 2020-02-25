@extends('layouts.app');
@section('content')
<div class="container">
  @if (session()->has('success'))
       .<div class="alert alert-success alert-dismissible fade show" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
        <strong>{{ session()->get('success') }}</strong> 
       </div>
       
       <script>
         $(".alert").alert();
       </script>
  @endif
    <form action="{{ isset($service)? route('services.update', $service->id) : route('services.store') }}" method="POST" enctype="multipart/form-data">

        @csrf
        @if (isset($service))
            @method('PUT')
        @endif
        <div class="form-group">
          <label for="exampleFormControlInput1">Service Title</label>
        <input name="title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title for this service" value="{{ isset($service) ? $service->title : '' }}">
        </div>

      
        <div class="form-row mt-2 mb-2">
          <div class="col-md mt-2">
            <label for="real_price">real price</label>
            <input type="text" name="real_price" id="real_price" class="form-control" placeholder="real price" aria-describedby="real_price" value="{{ isset($service) ? floatval($service->real_price)   : '' }}">
          </div>
          <div class="col-md mt-2 mt-xs-4">
            <label for="price">new price</label>
            <input type="text" name="price" id="price" class="form-control" placeholder="enter new price" aria-describedby="price" value="{{ isset($service) ? floatval($service->price) : '' }}">
          </div>
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Category</label>
          <select name="category_id" class="form-control" id="exampleFormControlSelect1">
            @foreach ($categories as $category)
          <option value="{{ $category->id }}" @if (isset($service) && $service->category_id == $category->id)
              selected
          @endif>{{ $category->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="exampleFormControlSelect1">Service Type</label>
          <select name="servicetype_id" class="form-control" id="exampleFormControlSelect1">
            @foreach ($servicetypes as $servicetype)
          <option value="{{ $servicetype->id }}" @if (isset($service) && $service->servicetype_id == $servicetype->id)
              selected
          @endif>{{ $servicetype->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Description</label>
          <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="2">{{ isset($service) ? $service->description : '' }}</textarea>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">content</label>
          <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ isset($service) ? $service->content : '' }}</textarea>
        </div>
        @if (isset($service) && $service->image !=false)
            <div class="form-group">
              <img src="{{ asset('storage/' . $service->image) }}" alt="" class="img-fluid" width="50%">
            </div>
       @endif
        <div class="form-group">
          <label for="servicImage">Service Image</label>
          <input name="image" type="file" accept="image/*" class="form-control-file" id="servicImage">
        </div>

        <button class="btn btn-success">add</button>
    </form>
</div>
@endsection