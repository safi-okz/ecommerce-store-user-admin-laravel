@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Product</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="products.html" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="" method="POST" name="productForm" id=productForm>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                                    <p class="error"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">
                                    <p class="error"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Media</h2>
                        <div id="image" class="dropzone dz-clickable">
                            <div class="dz-message needsclick">
                                <br>Drop files here or click to upload.<br><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="product-gallery">

                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Pricing</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                                    <p class="error"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="compare_price">Compare at Price</label>
                                    <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                    <p class="text-muted mt-3">
                                        To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Inventory</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sku">SKU (Stock Keeping Unit)</label>
                                    <input type="text" name="sku" id="sku" class="form-control" placeholder="sku">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="barcode">Barcode</label>
                                    <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="hidden" name="track_qty" id="track_qty" value="No">
                                        <input class="custom-control-input" type="checkbox" id="track_qty" value="Yes" name="track_qty" checked>
                                        <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                        <p class="error"></p>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="number" min="0" name="qty" id="qty" class="form-control" placeholder="Qty">
                                    <p class="error"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Product status</h2>
                        <div class="mb-3">
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Block</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2 class="h4  mb-3">Product category</h2>
                        <div class="mb-3">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select Category</option>
                                @if($categories->isNotEmpty())
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <p class="error"></p>
                        </div>
                        <div class="mb-3">
                            <label for="category">Sub category</label>
                            <select name="sub_category" id="sub_category" class="form-control">
                                <option value="">Select Subcategory</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Product brand</h2>
                        <div class="mb-3">
                            <select name="brand" id="brand" class="form-control">
                                <option value="">Select Brand</option>
                                @if($brands->isNotEmpty())
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Featured product</h2>
                        <div class="mb-3">
                            <select name="is_featured" id="is_featured" class="form-control">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                            <p class="error"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="products.html" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('customJs')
<script>
$('#title').change(function() {
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
  });

//   $('#productForm').submit(function(event) {
//         event.preventDefault();
//         let formArray = $(this);
//         $.ajax({
//             url: '{{ route("products.store") }}',
//             type: 'POST',
//             data: formArray.serializeArray(),
//             dataType: 'json',
//             success: function(response) {
//                     if(response['status'] == true) {

//                     } else {
//                         let errors = reponse['errors'];
//                         if(errors['title']) {
//                             $('#title').addClass('is-invalid').siblings('p')
//                                 .addClass('invalid-feedback')->html(errors['title']);
//                         } else {
//                             $('#title').removeClass('is-invalid').siblings('p')
//                                 .removeClass('invalid-feedback')->html('');
//                         }
//                     }
//             },
//             error: function() {
//                 console.log('Something went wrong');
//             }
//         })
//   });

$(document).ready(function() {
    $('#productForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Serialize form data
        let formData = $(this).serializeArray();

        $("button[type='submit']").prop('disabled', true);

        $.ajax({
            url: '{{ route("products.store") }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                $("button[type='submit']").prop('disabled', false);
                if (response.status === true) {

                    $(".error").removeClass('invalid-feedback').html('');
                    $("input[type='text'], select, input[type='number']").removeClass('is-invalid');

                    window.location.href = "{{ route('product.index') }}";
                } else {
                    // Handle validation errors
                    let errors = response.error;

                    $(".error").removeClass('invalid-feedback').html('');
                    $("input[type='text'], select, input[type='number']").removeClass('is-invalid');

                    $.each(errors, function(key, value) {
                        $(`#${key}`).addClass('is-invalid').siblings('p')
                        .addClass('invalid-feedback').html(value);
                    })

                    // // Check for each potential error and update the DOM accordingly
                    // if (errors['title']) {
                    //     $('#title').addClass('is-invalid').siblings('p')
                    //         .addClass('invalid-feedback').html(errors.title);
                    // } else {
                    //     $('#title').removeClass('is-invalid').siblings('p')
                    //         .removeClass('invalid-feedback').html('');
                    // }

                    // if (errors.slug) {
                    //     $('#slug').addClass('is-invalid').siblings('p')
                    //         .addClass('invalid-feedback').html(errors.slug);
                    // } else {
                    //     $('#slug').removeClass('is-invalid').siblings('p')
                    //         .removeClass('invalid-feedback').html('');
                    // }

                    // if (errors.price) {
                    //     $('#price').addClass('is-invalid').siblings('p')
                    //         .addClass('invalid-feedback').html(errors.price);
                    // } else {
                    //     $('#price').removeClass('is-invalid').siblings('p')
                    //         .removeClass('invalid-feedback').html('');
                    // }

                    // Repeat for other fields as necessary
                }
            },
            error: function(xhr, status, error) {
                // Log error details for debugging
                console.log('AJAX error:', status, error);
                console.log(xhr.responseText);
            }
        });
    });
});


  $('#category').change(function(event){
    event.preventDefault();

    let category_id = $(this).val();
        $.ajax({
            url: '{{ route("product-subcategories.index") }}',
            type: 'get',
            data: {category_id: category_id},
            dataType: 'json',
            success: function(response) {
                console.log("response ", response);
                $('#sub_category').find('option').not(':first').remove();
                $.each(response['subcategories'], function(key, item) {
                    $('#sub_category').append(`<option value='${item.id}'>${item.name}</option>`);
                })
            },
            error: function() {
                console.log('Something went wrong');
            }
        })
  })

  Dropzone.autoDiscover = false;
const dropzone = $("#image").dropzone({
    // init: function() {
    //     this.on('addedfile', function(file) {
    //         if (this.files.length > 1) {
    //             this.removeFile(this.files[0]);
    //         }
    //     });
    // },
    url:  "{{ route('temp-images.create') }}",
    maxFiles: 10,
    paramName: 'image',
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg,image/png,image/gif",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }, success: function(file, response){
        // $("#image_id").val(response.image_id);
        //console.log(response)

        var html = `
                    <div class="col-md-3" id="image-row-${response.image_id}">
                    <input type="hidden" name="image_array[]" value="${response.image_id}"
                    <div class="card" style="width: 18rem;">
                    <img src="${response.imagePath}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="btn btn-danger">Delete</a>
                    </div>
                    </div>
                    </div>`
            $('#product-gallery').append(html);
    },

    complete: function(file) {
        this.removeFile(file);
    }
});

function deleteImage(id) {
    $(`#image-row-${id}`).remove();
}
</script>
@endsection
