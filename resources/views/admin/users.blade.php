@extends('dashboard_layouts/template')

@section('dashboard_layouts/content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Manage Users</h3>
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <li>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" id="role-filter">
                                    @forelse ($roles as $role)
                                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                    @empty
                                    @endforelse
                                        <option value="all">All</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li class="nk-block-tools-opt">
                            <a href="#" data-target="add-user" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                            <a href="#" data-target="add-user" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add User</span></a>
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
                <table id="users-table" class="datatable-init table nowrap">

                </table>
            </div>
        </div>
    </div>
</div><!-- .nk-block -->
<div class="nk-add-product toggle-slide toggle-slide-right" data-content="add-user" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">New User</h5>
            <div class="nk-block-des">
                <p>Add information and add new user.</p>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <form class="form-validate" id="add-user-form">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="full-name">Full Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="full-name" name="full_name" required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <div class="form-control-wrap">
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="phone">Phone</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label" for="role">Role</label>
                        <div class="form-control-wrap ">
                            <div class="form-control-select">
                                <select class="form-control" id="role" name="roles" required>
                                    <option value="">Select a role...</option>
                                @forelse ($roles as $role)
                                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                @empty
                                @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label" for="fv-phone">Status</label>
                        <div class="form-control-wrap">
                            <ul class="custom-control-group">
                                <li>
                                    <div class="custom-control custom-radio custom-control-pro no-control checked">
                                        <input type="radio" class="custom-control-input valid" name="status" id="status-active" value="1" required="" aria-describedby="fv-status-error" aria-invalid="false">
                                        <label class="custom-control-label" for="status-active">Active</label>
                                        <span id="fv-status-error" class="invalid" style="display: none;"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio custom-control-pro no-control">
                                        <input type="radio" class="custom-control-input valid" name="status" id="status-inactive" value="0" required="" aria-invalid="false">
                                        <label class="custom-control-label" for="status-inactive">Inactive</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="customFileLabel">Profile Picture</label>
                        <div class="form-control-wrap">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="add-user-image" name="user_image" accept="image/*">
                                <label class="custom-file-label" for="add-user-image">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <img id="preview-add-image" src="#" alt="Preview Image" style="display: none;">
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                </div>
            </div>
        </form>
    </div><!-- .nk-block -->
</div>
@endsection
@section('dashboard_layouts/modal')
<!-- Edit User Modal Form -->
<div class="modal fade" id="edit-user-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Existing User</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <form action="#" class="form-validate is-alter" id="edit-user-form">
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="edit-full-name">Full Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" data-msg="fullname is required" id="edit-full-name" name="full_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="edit-email">Email</label>
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" id="edit-email" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="edit-phone">Phone</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="edit-phone" name="phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="edit-role">Role</label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select class="form-control" id="edit-role" name="roles" required>
                                            <option value="">Select a role...</option>
                                        @forelse ($roles as $role)
                                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                        @empty
                                        @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-phone">Status</label>
                                <div class="form-control-wrap">
                                    <ul class="custom-control-group">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-pro no-control checked">
                                                <input type="radio" class="custom-control-input valid" name="status" id="edit-status-active" value="1" required="" aria-describedby="fv-status-error" aria-invalid="false">
                                                <label class="custom-control-label" for="edit-status-active">Active</label>
                                                <span id="fv-status-error" class="invalid" style="display: none;"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-pro no-control">
                                                <input type="radio" class="custom-control-input valid" name="status" id="edit-status-inactive" value="0" required="" aria-invalid="false">
                                                <label class="custom-control-label" for="edit-status-inactive">Inactive</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="customFileLabel">Profile Picture</label>
                                <div class="form-control-wrap">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="edit-user-image" name="user_image" accept="image/*">
                                        <label class="custom-file-label" for="edit-user-image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <img id="preview-edit-image" src="#" alt="Preview Image" style="display: none;">
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
<!-- Edit User Modal Form -->    
@endsection
@section('dashboard_layouts/script')
<script>

    //Datatable
    NioApp.DataTable('.datatable-init', {
        responsive: {
            details: true
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("admin.manage-user.list", "") }}/' + $('#role-filter').val(),
            // data: function (d){
            //     d.roleName = $('#role-filter').val();
            // }
        },
        columns: [
            {title: 'SN', data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {
                title: 'Full Name', 
                data: null, 
                render: function (data, type, row) {
                    let fullNameTd = `<span class="tb-product d-flex align-items-center">`;
                    if(row.avatar == null){
                        fullNameTd += `<div class="user-avatar sq bg-primary tw-capitalize"><span>${getFirstLetters(row.full_name)}</span></div>`;
                    }else{
                        fullNameTd += `<img src="${row.avatar}" alt="" class="thumb rounded" height="40">`;
                    }
                    fullNameTd += `
                        <span class="title ml-1">${row.full_name}</span>
                    </span>
                    `;
                    return fullNameTd;
                }
            },
            {title: 'Email', data: 'email', name: 'email' },
            {title: 'Phone', data: 'phone', name: 'phone' },
            {title: 'Role', data: 'roles', name: 'roles' },
            {title: 'Status', data: 'status', name: 'status' },
            {
                title: 'Actions',
                data: null,
                orderable: false, 
                searchable: false, 
                render: function (data, type, row){
                    const userJSON = jsonStringParser(row);
                    return `
                    <td>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    <li><a href="#" data-toggle="modal" data-target="#edit-user-modal" data-info="${userJSON}">
                                        <em class="icon ni ni-edit"></em><span>Edit User</span>
                                    </a></li>
                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View User</span></a></li>
                                    <li><a href="#" onclick="deleteUser(${row.id})"><em class="icon ni ni-trash"></em><span>Remove User</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    `;
                }
            }
        ],
    });

    // Handle change event of role filter
    $('#role-filter').on('change', function() {
        $('.datatable-init').DataTable().ajax.url('{{ route("admin.manage-user.list", "") }}/' + $(this).val()).load();
    });

    // Preview image for add form
    $('#add-user-image').change(function() {
        let file = this.files[0];
        let fileSize = file.size;
        let fileType = file.type;

        if(!fileType.startsWith('image/')){
            vt.error('File type should be of image');
            this.value = '';
            return;
        }

        // error thrown if file size more than 2 Mb
        if(fileSize > 2 * 1024 * 1024){
            vt.error('Profile Picture shouldn\'t exceed 2 Mb');
            this.value = '';
            return;
        }

        let reader = new FileReader();
        reader.onload = function(e) {
            $('#preview-add-image').attr('src', e.target.result);
            $('#preview-add-image').show();
        };
        reader.readAsDataURL(file);
    });

    // Preview image for edit form
    $('#edit-user-image').change(function() {
        let file = this.files[0];
        let fileSize = file.size;
        let fileType = file.type;

        if(!fileType.startsWith('image/')){
            vt.error('File type should be of image');
            this.value = '';
            return;
        }

        // error thrown if file size more than 2 Mb
        if(fileSize > 2 * 1024 * 1024){
            vt.error('Profile Picture shouldn\'t exceed 2 Mb');
            this.value = '';
            return;
        }

        let reader = new FileReader();
        reader.onload = function(e) {
            $('#preview-edit-image').attr('src', e.target.result);
            $('#preview-edit-image').show();
        };
        reader.readAsDataURL(file);
    });

    function clearPreviewAddImage(){
        $('#preview-add-image').attr('src', '#');
        $('#preview-add-image').hide();
    }

    // Add User
    $('#add-user-form').on('submit', function(e){
        e.preventDefault();
        if($('#add-user-form').valid()){
            const formData = {
                'full_name': $('#full-name[name="full_name"]').val(),
                'email': $('#email[name="email"]').val(),
                'phone': $('#phone[name="phone"]').val(),
                'status': $('#add-user-form input[name="status"]').val(),
                'roles': $('#role[name="roles"]').val(),
                'user_image': $('#add-user-image').prop('files')[0],
            };
            const storeFormData = convertToFormData(formData);

            axios.post('manage-user', storeFormData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                vt.success(response.data);
                // $('.datatable-init').DataTable().ajax.reload();
                // alternative way to refresh datatable which has extra filter involved
                $('#role-filter').val($('#add-user-form select[name="roles"]').val()).trigger('change');
                $("#add-user-form").trigger("reset");
                clearPreviewAddImage();
                $('div[data-content="add-user"]').removeClass("content-active");
                $('body').removeClass("toggle-shown");
                $('.toggle-overlay[data-target="add-user"]').remove();
            })
            .catch(error => {
                vt.error(error.response.data.message);
            });
        }
    });

    let toEditUser = {};
    $(document).on('click','[data-target="#edit-user-modal"]', function(e){
        toEditUser = $(this).data('info');
        $('#edit-full-name[name="full_name"]').val(toEditUser.full_name);
        $('#edit-email[name="email"]').val(toEditUser.email);
        $('#edit-phone[name="phone"]').val(toEditUser.phone);
        $('#edit-role[name="roles"]').val(toEditUser.roles);
        $('#edit-user-form input[name=status][value=' + toEditUser.status + ']').prop('checked',true);

        if(toEditUser.avatar != null){
            $('#preview-edit-image').attr('src', toEditUser.avatar);
            $('#preview-edit-image').show();
        }else{
            $('#preview-edit-image').attr('src', '#');
            $('#preview-edit-image').hide();
        }
    });
    
    // Update User
    $('#edit-user-form').on('submit', function(e){
        e.preventDefault();
        
        if($('#edit-user-form').valid()){
            // Get latest edited form data
            const formData = {
                'id': toEditUser.id,
                'full_name': $('#edit-full-name[name="full_name"]').val(),
                'email': $('#edit-email[name="email"]').val(),
                'phone': $('#edit-phone[name="phone"]').val(),
                'status': $('#edit-user-form input[name="status"]').val(),
                'roles': $('#edit-role[name="roles"]').val(),
                'user_image': $('#edit-user-image').prop('files')[0],
            };
            const storeFormData = convertToFormData(formData);
            storeFormData.append("_method", "PATCH");
            axios.post('manage-user/'+formData.id, storeFormData)
                .then(response => {
                    vt.success(response.data);
                    $('.datatable-init').DataTable().draw(false);
                    $("#edit-user-form").trigger("reset");
                    $('#edit-user-modal a.close').trigger('click');
                }).catch(err => {
                    vt.error(err.response.data.message);
                })
        }
    });

    // Delete User
    function deleteUser(id){
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
                    axios.delete("manage-user/" + id)
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