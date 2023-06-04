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
                            <a href="#" data-target="addProduct" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                            <a href="#" data-target="addProduct" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Category</span></a>
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
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!-- .nk-block -->
<div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">New Product</h5>
            <div class="nk-block-des">
                <p>Add information and add new product.</p>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-3">
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="product-title">Product Title</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" id="product-title">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="regular-price">Regular Price</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" id="regular-price">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="sale-price">Sale Price</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" id="sale-price">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="stock">Stock</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" id="stock">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="SKU">SKU</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" id="SKU">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="category">Category</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" id="category">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="tags">Tags</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" id="tags">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="upload-zone small bg-lighter my-2">
                    <div class="dz-message">
                        <span class="dz-message-text">Drag and drop file</span>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
            </div>
        </div>
    </div><!-- .nk-block -->
</div>
@endsection
@section('dashboard_layouts/modal')
    
@endsection
@section('dashboard_layouts/script')
<script>
    $(document).ready(function() {
        
        NioApp.DataTable('.datatable-init', {
            responsive: {
                details: true
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.category.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'category_name', name: 'category_name'},
                {
                    data: null,
                    name: 'actions', 
                    orderable: false, 
                    searchable: false, 
                    render: function (data, type, row){
                        return `Render Action`;
                    }
                }
            ],
        });


    })
</script>

@endsection