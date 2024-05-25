@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Brand</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="brands.html" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="" id="createBrandForm" name="createBrandForm" method="post">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $brand->name }}" placeholder="Name">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ $brand->slug }}" placeholder="Slug">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="staus">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option {{ $brand->status === 1 ? 'selected' : '' }} value="1">Active</option>
                                <option {{ $brand->status === 0 ? 'selected' : '' }} value="0">Block</option>
                            </select>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="brands.html" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('customJs')
<script>
$('#createBrandForm').submit(function(event){
        event.preventDefault();
        var element = $(this)
        $.ajax({
            url: '{{ route("brand.update", $brand->id) }}',
            type: 'put',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response){

                if(response['status'] === true) {

                    // $('#name').removeClass('is-invalid').siblings('p')
                    // .removeClass('invalid-feedback').html('');

                    // $('#slug').removeClass('is-invalid').siblings('p')
                    // .removeClass('invalid-feedback').html('');
                } else {
                    if(response['notFound'] === true) {
                        window.location.href = "{{ route('brand.index')}}";
                        return false;
                    }
                var errors = response['errors'];
                if(errors['name']){
                    $('#name').addClass('is-invalid').siblings('p')
                    .addClass('invalid-feedback').html(errors['name']);
                } else {
                    $('#name').removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html('');
                }

                if(errors['slug']){
                    $('#slug').addClass('is-invalid').siblings('p')
                    .addClass('invalid-feedback').html(errors['slug']);
                } else {
                    $('#slug').removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html('');
                }

                if(errors['category']){
                    $('#category').addClass('is-invalid').siblings('p')
                    .addClass('invalid-feedback').html(errors['category']);
                } else {
                    $('#category').removeClass('is-invalid').siblings('p')
                    .removeClass('invalid-feedback').html('');
                }
                }
            },
            error: function(jqXHR, exception) {
                console.log('Someting went wrong')
            }
        })
    });

$('#name').change(function() {
      let element = $(this);
      console.log('status ', element.val());
      $.ajax({
              url: '{{ route("getSlug") }}',
              type: 'get',
              data: {title: element.val() },
              dataType: 'json',
              success: function(response){
                if(response['status'] == true) {
                     $('#slug').val(response['slug']);
                }
              }

      });
  })
</script>
@endsection
