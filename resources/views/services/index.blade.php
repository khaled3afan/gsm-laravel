@extends('layouts.app')
@section('content')


    <!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Service</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body edit-service-modal">
            <form enctype="multipart/form-data" method="POST" action="" id="edit-form">
                @csrf
                <div class="form-group">
                  <label for="title" class="col-form-label">Title:</label>
                  <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-row mt-2 mb-2">
                    <div class="col-md mt-2">
                      <label for="real_price">real price</label>
                      <input type="text" name="real_price" id="real_price" class="form-control" placeholder="real price" aria-describedby="real_price" value="">
                    </div>
                    <div class="col-md mt-2 mt-xs-4">
                      <label for="price">new price</label>
                      <input type="text" name="price" id="price" class="form-control" placeholder="enter new price" aria-describedby="price" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control" id="category_id">
                      @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if (isset($service) && $service->category_id == $category->id)
                        selected
                    @endif>{{ $category->name }}</option>
                      @endforeach
                    </select>
                </div>
          
                <div class="form-group">
                    <label for="servicetype_id">Service Type</label>
                    <select name="servicetype_id" class="form-control" id="servicetype_id">
                    @foreach ($servicetypes as $servicetype)
                    <option value="{{ $servicetype->id }}" @if (isset($service) && $service->servicetype_id == $servicetype->id)
                        selected
                    @endif>{{ $servicetype->name }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="desc" class="col-form-label">Description:</label>
                    <textarea class="form-control" id="desc" name="description" placeholder="Description"></textarea>
                </div>
                <div class="form-group">
                    <label for="content">content</label>
                    <textarea id="content" class="form-control" name="content" rows="3" placeholder="Content"></textarea>
                </div>
                <input type="hidden" name="service_id" id="service_id">
                <div class="form-group d-none old-image">
                    <img src="" alt="" id="old_image" class="img-fluid" width="50%">
                </div>
{{-- 
                <div class="form-group">
                    <label for="service_image">Service Image</label>
                    <input name="image" type="file" accept="image/*" class="form-control-file" id="service_image">
                </div> --}}     
        
                <div class="form-group">
                <label for="accept_info">Accept Info</label>
                <select name="accept_info" class="form-control" id="accept_info">
                <option value="0">NO</option>
                <option value="1">YES</option>
                </select>
                </div>
        
                <div class="form-group">
                <label for="info_label">Info Label</label>
                <input id="info_label" class="form-control" type="text" name="info_label" value="{{ $service->info_label ?? '' }}">
                </div>
        
                <div class="form-group">
                <label for="info_placeholder">Info Place Holder</label>
                <input id="info_placeholder" class="form-control" type="text" name="info_placeholder" value="{{ $service->info_placeholder ?? '' }}">
                </div>
            
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning mr-auto" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="update-service" data-serviceid="">Save changes</button>
        </div>
      </div>
    </div>
  </div>







    <div class="card">
        
        <div class="card-header bg-primary text-white">{{$type ?? 'Services' }}</div>
        <div>
            <a href="{{ route('services.create') }}" class="btn btn-outline-success btn-lg m-2">Add New Service</a>
        </div>

        <div class="card-body">

            <table class="table table-hover table-bordered table-responsive">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">description</th>
                    <th scope="col">actions</th>
                  </tr>
                </thead>
                <tbody>
                @if ($services->count() > 0)
                    @php
                        $counter= 0;
                    @endphp
                    @foreach ($services as $service)
                    @php
                        $counter++;
                    @endphp
                        <tr>
                            <th scope="row">{{ $counter }}</th>
                            <td class="title">{{ $service->title }} <br>
                                <img class="img-fluid" src="/storage/{{ $service->image }}" alt="{{ $service->title }}" style="height:100px;background:none;">
                            </td>
                            <td class="description">{{ $service->description }}</td>
                            <td class=" text-center">
                                @if (isset($service->servicetype) && $service->servicetype->name=='instant')
                                <a href="{{ route('servicecodes.create', $service->id) }}" class="btn btn-success  m-1"> <i class="fas fa-gift"></i></a>
                                @endif

                                <a href="{{ route('bundles.create', $service->id) }}" class="btn btn-secondary  m-1"> <i class="fas fa-box-open"></i></a>

                                <a href="{{ route('services.show', $service->id) }}" class="btn btn-info  m-1 text-white"> <i class="fas fa-eye"></i></a>
                                <br class="d-md-none">
                                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary  m-1 edit-service"  data-service="{{ $service->id }}"> <i class="fas fa-edit"></i></a>

                                <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline-block m-1 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" style="cursor:pointer"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td scop="row" colspan="3" class="text-center">
                        there's no services yet
                    </td>
                </tr>
                @endif
                </tbody>
              </table>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(function() {

        // $.fn.mySerialize = function() {
        //     var returning = '';
        //     $('input, textarea',this).each(function(){
        //         var name = this.name;
        //         var value = this.value;
        //         returning += name + '=' + value + '&';
        //     });
        //     return returning;
        // };

        function hideAlert() {
                        $('.alert').alert('close');
                        $('.alert').hide();
                    }



        $('.edit-service').on('click', function(e){
            e.preventDefault();
            var service_id = $(this).data('service')
            $.ajax({
                type: "get",
                url: "/api/services/"+service_id+'/edit',
                success: function (res, status) {
                    $('.edit-service-modal form #title').val(res.title);
                    $('.edit-service-modal form #desc').val(res.description);
                    $('.edit-service-modal form #content').val(res.content);
                    $('.edit-service-modal form #real_price').val(res.real_price);
                    $('.edit-service-modal form #price').val(res.price);
                    $(`.edit-service-modal form #category_id option[value='${res.category_id}']`).attr('selected', 'selected');
                    $(`.edit-service-modal form #servicetype_id option[value='${res.servicetype_id}']`).attr('selected', 'selected');
                    $(`.edit-service-modal form #accept_info option[value='${res.accept_info}']`).attr('selected', 'selected');
                    $('.edit-service-modal form #info_label').val(res.info_label);
                    $('.edit-service-modal form #info_placeholder').val(res.info_placeholder);
                    $('#service_id').val(service_id);
                    if(res.image !=''){
                        $('.old-image').removeClass('d-none');
                        $('.edit-service-modal form #old_image').attr(`src`, `/storage/${res.image}`);
                    }
                    $('.modal').modal('show');
                    $('.alert').slideUp();
                }
            }).fail(function(e, s){
                alert(s);
            });

        });
        var image;
        $(document).on('change', '#service_image', function() {
           image = document.getElementById('service_image').files[0];
        });
        $(document).on('click', '#update-service', function(e) {
            $('.edit-service-modal form').submit();
        });
        $(document).on('submit', '.edit-service-modal form', function(e) {
            e.preventDefault();
            hideAlert();
            var editErrors='';
            var form = document.getElementById('edit-form');
            var service_id = $('#service_id').val();
            var data = $(form).serialize();
            $.ajax({
                type: "PATCH",
                url: "/api/services/"+service_id,
                data: data,
                success: function (response) {
                    $('.modal').modal('hide');
                    $('.modal form').trigger('reset');
                    $('.card .card-body').prepend(`
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            the service has been edited
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);

                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function (key, val) {
                        editErrors += `<div class="alert alert-danger" role="alert">
                            ${val[0]}
                        </div>`;
                    });
                    $('.edit-service-modal form').prepend(editErrors);
                }
            });
        })
    });
</script>

@endpush