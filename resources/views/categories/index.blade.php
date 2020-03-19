@extends('layouts.app')
@section('content')
<div class="table-responsive">

    <div id="editCategory" class="modal edit-category-modal fade" tabindex="-1" role="dialog" aria-labelledby="edit_category-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_category-title">edit category</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="edit-form">
                        @csrf
                        <div class="form-group">
                          <label for="title" class="col-form-label">Category Name:</label>
                          <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <input type="hidden" name="category_id" id="category_id">
                    
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update-category" data-serviceid="">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <table class="table table-bordered">
        <thead class="">
            <tr class="text-center table-info">
                <th scope="col">Name</th>
                <th scope="col">Services count</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <a href="{{ route('categories.create')  }}" class="btn btn-primary" style="border-radius:0;border-top-left-radius:5px">create new category</a>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>
                    {{ $category->name }}
                </td>
                <td>
                    {{ $category->services->count() }}
                </td>
                <td class=" text-center">
                    <a href="{{ route('index.category', $category->id) }}" class="btn btn-info  m-1 text-white"> <i class="fas fa-eye"></i></a>
                    <br class="d-md-none">
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary  m-1 edit-category"  data-category="{{ $category->id }}"> <i class="fas fa-edit"></i></a>
                    @if ($category->id !='1')
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline-block m-1 p-0">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="cursor:pointer"><i class="fas fa-trash"></i></button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
    <script>
        $(function() {
            $(document).on('click', '.edit-category', function(e) {
                e.preventDefault();
                var category_id = $(this).data('category')
                $.ajax({
                    type: "get",
                    url: "/api/categories/"+category_id+"/edit",
                    success: function (response) {
                        $('.edit-category-modal form #name').val(response.name);
                        $('.edit-category-modal form #category_id').val(category_id);
                    }
                });

                $('.modal').modal('show');
            });
            $(document).on('click', '#update-category', function(e) {
            $('.edit-category-modal form').submit();
        });
            $(document).on('submit', '.edit-category-modal form', function(e) {
                e.preventDefault();
                var editErrors='';
                var form = document.getElementById('edit-form');
                var category_id = $('#category_id').val();
                var data = $(form).serialize();
                $.ajax({
                    type: "PATCH",
                    url: "/api/categories/"+category_id,
                    data: data,
                    success: function (response) {
                        $('.modal').modal('hide');
                        $('.table-responsive').prepend(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                the category has been edited
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
                        $('.edit-category-modal form').prepend(editErrors);
                    }
                });
            })
        });
    </script>
@endpush