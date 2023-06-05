@extends('dashboard_layouts/template')

@section('dashboard_layouts/content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Categories</h3>
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <li class="nk-block-tools-opt">
                            <a href="#" data-target="addCategory" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                            <a href="#" data-target="addCategory" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Category</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block">
    <div class="card card-bordered">
        <div class="card-inner-group">
            <div class="card-inner p-4">
                <!-- Table here...  -->
                <table class="datatable-init nowrap table" id="categories-table">
                </table>
            </div>
        </div>
    </div>
</div><!-- .nk-block -->
<!-- Start of Add Category Slider -->
<div class="nk-add-product toggle-slide toggle-slide-right" data-content="addCategory" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">New Category</h5>
            <div class="nk-block-des">
                <p>Add information and add new category.</p>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <form action="#" method="POST" class="form-validate" id="add-category-form">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="category-name">Category Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="category-name" name="category_name" required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                </div>
            </div>
        </form>
    </div><!-- .nk-block -->
</div>
<!-- End of Add Category Slider -->
@endsection
@section('dashboard_layouts/modal')
<!-- Edit Category Modal Form -->
<div class="modal fade" id="editCategoryModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Existing Category</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <form action="#" class="form-validate is-alter" id="edit-category-form">
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label" for="edit-category-name">Category Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" data-msg="category is required" id="edit-category-name" name="category_name" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary tw-mr-2">Update</button>
                        <button type="reset" data-dismiss="modal" class="btn btn-lg btn-light">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Category Modal Form -->
@endsection
@section('dashboard_layouts/script')
<script>
    // $(document).ready(function() {
    // })
        
    //Datatable
    NioApp.DataTable('.datatable-init', {
        responsive: {
            details: true
        },
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.category.list') }}",
        columns: [
            {title: 'SN', data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {title: 'Name', data: 'category_name', name: 'category_name'},
            {
                title: 'Actions',
                data: null,
                name: 'actions', 
                orderable: false, 
                searchable: false, 
                render: function (data, type, row){
                    const categoryJSON = jsonStringParser(row);
                    return `
                    <td>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    <li><a href="#" data-toggle="modal" data-target="#editCategoryModal" data-info="${categoryJSON}">
                                        <em class="icon ni ni-edit"></em><span>Edit Category</span>
                                    </a></li>
                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Category</span></a></li>
                                    <li><a href="#" onclick="deleteCategory(${row.id})"><em class="icon ni ni-trash"></em><span>Remove Category</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    `;
                }
            }
        ],
    });

    // Add Category
    $('#add-category-form').on('submit', function(e){
        e.preventDefault();
        if($('#add-category-form').valid()){
            const formData = $('#add-category-form').serialize();
            axios.post('category', formData)
                .then(response => {
                    vt.success(response.data);
                    $('.datatable-init').DataTable().ajax.reload();
                    $("#add-category-form").trigger("reset");
                    // 3 manual step for closing slider :O 
                    // more beneficial to use modal next time for insert!
                    $('div[data-content="addCategory"]').removeClass("content-active");
                    $('body').removeClass("toggle-shown");
                    $('.toggle-overlay[data-target="addCategory"]').remove();
                })
                .catch(error => {
                    vt.error(error.response.data.message);
                });
        }
    });

    /*
    $('[data-target="#editCategoryModal"]').on('click', function(e) {
        const categoryData = $(this).data('info');
        $('#edit-category-name[name="category_name"]').val(categoryData.category_name);
    });
    */

    let toEditCategory = {};
    $(document).on('click','[data-target="#editCategoryModal"]', function(e){
        toEditCategory = $(this).data('info');
        $('#edit-category-name[name="category_name"]').val(toEditCategory.category_name);
    });
    
    // Update Category
    $('#edit-category-form').on('submit', function(e){
        e.preventDefault();

        // Get latest edited form data
        editedFormData = {
            'id': toEditCategory.id,
            'category_name': $('#edit-category-name[name="category_name"]').val(),
        };

        if($('#edit-category-form').valid()){
            axios.patch('category/'+editedFormData.id, editedFormData)
                .then(response => {
                    vt.success(response.data);
                    // draw(false) will only update the data required for current pagination. So, better for updating & deleting data
                    // ajax().reload() will update the entire datatable and go to page 1 which will be beneficial for adding data
                    $('.datatable-init').DataTable().draw(false);
                    // $('#editCategoryModal').modal('hide'); -> not working!
                    // alternative for closing modal, works fine :)
                    $('#editCategoryModal a.close').trigger('click');
                }).catch(err => {
                    vt.error(err.response.data.message);
                })
        }
    });

    // Delete Category
    function deleteCategory(id){
        Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0971fe',
                confirmButtonText: 'Yes, delete it!'
            })
            .then(function(result) {
                if (result.value) {
                    axios.delete("category/" + id)
                        .then(res => {
                            vt.success(res.data);
                            $('.datatable-init').DataTable().draw(false);
                        }).catch(err => {
                            vt.error(err.response.data.message);
                        })
                }
            });
    }
</script>

@endsection