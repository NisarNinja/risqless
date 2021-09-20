@extends('admin.layouts.app')

@section('title', 'Update Category')

@push('before-styles')
    <link href="{{ asset('admin/css/layout.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('after-scripts')
    <script src="{{ asset('admin/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('admin/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/tables/datatables/extensions/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
    <script src="{{ asset('admin/js/myapp.js') }}"></script>
    <script src="{{ asset('admin/js/custom.js') }}"></script>
    <script src="{{ asset('admin/js/demo_pages/datatables_extension_buttons_html5.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset('admin/js/demo_pages/form_multiselect.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/visualization/d3/d3.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
    <script src="{{ asset('admin/js/demo_pages/dashboard.js') }}"></script>
@endpush

@section('content')
    @include('admin.includes.navbar')
    <!-- Page content -->
    <div class="page-content" style="margin-top: 0px; ">
        <!-- Main sidebar -->
    @include('admin.includes.sidebar')
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
                @include('admin.includes.pageheader')
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">


                <!-- Dashboard content -->
                <div class="row">
                    <div class="col-xl-12">

                        <!-- /quick stats boxes -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header header-elements-inline">
                                            <h6 class="card-title">{{(!isset($category)) ? 'Update' : 'Add'}} Category </h6>
                                            <div class="header-elements">
                                                <div class="list-icons">
                                                    <a class="list-icons-item" data-action="collapse"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if(isset($category))
                                                {{ Form::model($category,['method'=>'put','route' => ['categories.update', $category->id] , 'class' => 'js-form', 'enctype' => 'multipart/form-data']) }}
                                            @else
                                                {{ Form::open(['route' => 'categories.index' , 'class' => 'js-form', 'enctype' => 'multipart/form-data']) }} 
                                            @endif
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('type','Select Type') }}<span style="color:red;">*</span>

                                                        <select name="type" id="type" class="form-control select2 dynamic" data-dependent="parent_id" data-validate-field="type">
                                                            <option value="">Please Select Type of Category</option>
                                                            <option value="place">Place</option>
                                                            <option value="service">Service</option>
                                                        </select>

                                                        {!! $errors->first('type', '<label id="type-error" class="error" for="type">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('parent_id','Select Parent Category') }}<span style="color:red;">*</span>

                                                        <select name="parent_id" id="parent_id" class="form-control select2" data-dependent="parent_id">
                                                            <option value="">Please First Select Type of Category</option>
                                                            
                                                        </select>

                                                        {!! $errors->first('parent_id', '<label id="parent_id-error" class="error" for="parent_id">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('name','Category Name') }}<span style="color:red;">*</span>
                                                        {{ Form::text('name',old('name'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Category Name', 'data-validate-field' => 'name')) }}
                                                        {!! $errors->first('name', '<label id="name-error" class="error" for="name">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('photo','User Image') }}<span style="color:red;">*</span>
                                                        {{ Form::file('photo',array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image' , 'data-validate-field' => 'photo')) }}
                                                        {!! $errors->first('photo', '<label id="photo-error" class="error" for="photo">:message</label>') !!}
                                                        <p id="error1" style="display:none; color:#B81111;">
                                                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                                                        </p>
                                                        <p id="error2" style="display:none; color:#B81111;">
                                                        Maximum File Size Limit is 5MB.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('photo','Current Image') }}
                                                        <br>
                                                        @if(empty($category->image))
                                                        <h4 class="text-info">No Image Uploaded yet!</h4>
                                                        @else
                                                       <img src="{{ $category->image }}" class="img-fluid img-thumbnail" alt="Responsive image" height="300px" width="300px">
                                                       @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end align-items-center">
                                                <button type="submit"  class="btn bg-blue ml-3">{{(!isset($category)) ? 'Update' : 'Save'}} </button>
                                            </div>
                                            {{ csrf_field() }}
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /dashboard content -->
            </div>
            <!-- /content area -->


            <!-- Footer -->
            @include('admin.includes.footer')
            <!-- /footer -->

        </div>
        <!-- /main content -->

    </div>

<!-- validation -->
<script type="text/javascript" src="{{ asset('admin/js/imageValidate.js') }}"></script>

<script src="{{ asset('js/just-validate.min.js') }}"></script>

<script type="text/javascript">
    
    // dependent dropdown 
    $('.dynamic').change(function(){
        if($(this).val() != ''){

            let select = $(this).attr('id');
            let value  = $(this).val();
            let dependent = $(this).data('dependent');
            let _token  = $('input[name="_token"]').val();
            
            $.ajax({
                url: '{{ route("dynamicdependent.fetch") }}',
                method: 'POST',
                data: {
                    select:select,
                    value:value,
                    dependent:dependent,
                    _token:_token
                },
                success:function(response){

                    $('#'+dependent).html(response);

                }
            })

        }
    })
    
    // searchable dropdown
    $('.select2').select2();

        new window.JustValidate('.js-form', {
        rules: {
            name: {
                required: true
            },
            type:{
                required:true
            },

        },
        messages: {
            name: {
                required: 'Category name is required',
            },
            type: {
                required: 'Category type is required',
            },

        },
    });
</script>
@endsection
