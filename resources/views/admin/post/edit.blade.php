@extends('admin.layouts.app')

@section('title', 'Update Post')

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

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

     <!-- tags input css -->
    <link href="{{ asset('admin/css/tagsinput.css') }}" rel="stylesheet" type="text/css">
    
    <style type="text/css">
        .bootstrap-tagsinput .badge {
            margin: 3px 6px;
            padding: 5px 8px;
            font-size:16px;
        }
    </style>

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
                                            <h6 class="card-title">{{(isset($post)) ? 'Update' : 'Add'}} Post </h6>
                                            <div class="header-elements">
                                                <div class="list-icons">
                                                    <a class="list-icons-item" data-action="collapse"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if(isset($post))
                                                {{ Form::model($post,['method'=>'put','route' => ['posts.update',$post->id],'enctype' => 'multipart/form-data' ]) }}
                                            @else
                                                {{ Form::open(['route' => 'posts.store' ,'enctype' => 'multipart/form-data'] ) }}
                                            @endif
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('user_id','Select User') }}<span style="color:red;">*</span>
                                                        {{ Form::select('user_id', $user ,null, ['class' => 'form-control select2', 'style'=> 'margin-bottom:20px;']) }}

                                                        {!! $errors->first('user_id', '<label id="user-id-error" class="error" for="user_id">:message</label>') !!}
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('photo','Featured Image') }}<span style="color:red;">*</span>
                                                        {{ Form::file('photo',array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image')) }}
                                                        {!! $errors->first('photo', '<label id="photo-error" class="error" for="photo">:message</label>') !!}
                                                        <p id="error1" style="display:none; color:#FF0000;">
                                                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                                                        </p>
                                                        <p id="error2" style="display:none; color:#FF0000;">
                                                        Maximum File Size Limit is 5MB.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('topic','Topic') }}<span style="color:red;">*</span>
                                                        {{ Form::text('topic',old('topic'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Topic' ,'data-validate-field' => 'topic')) }}
                                                        {!! $errors->first('topic', '<label id="topic-error" class="error" for="topic">:message</label>') !!}
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('tags','Tags') }}<span style="color:lightblue;">(Optional)</span>
                                                        {{ Form::text('tags',old('tags'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Tags', 'data-role' => 'tagsinput' ,'id' => 'courseTags')) }}
                                                        {!! $errors->first('tags', '<label id="tags-error" class="error" for="tags">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('excerpt','Excerpt') }}<span style="color:red;">*</span>
                                                        {{ Form::text('excerpt',old('excerpt'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Short Excerpt', 'data-validate-field' => 'excerpt')) }}
                                                        {!! $errors->first('excerpt', '<label id="excerpt-error" class="error" for="excerpt">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('description','Post Description') }}<span style="color:red;">*</span>

                                                        <textarea class="form-control" style="margin-bottom:10px;" name="description" placeholder="Write here..." data-validate-field="description" id="summernote"></textarea>

                                                        {!! $errors->first('description', '<label id="description-error" class="error" for="description">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end align-items-center">
                                                <button type="submit" class="btn bg-blue ml-3">{{(isset($post)) ? 'Update' : 'Save'}} </button>
                                            </div>

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
<!-- tags input js  -->
<script src="{{ asset('admin/js/tagsinput.js') }}"></script>

<script type="text/javascript" src="{{ asset('admin/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/imageValidate.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/myvalidate.js') }}"></script>
<script>
        // searchable dropdown
    $('.select2').select2();
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#summernote').val(`{!!$post->description!!}`);
        $('#summernote').summernote({
            height: '300px',
            placeholder: 'Content here...'
        });

        let description = $('#summernote_description').text();
        
    })
</script>

<script src="{{ asset('js/just-validate.min.js') }}"></script>

<script type="text/javascript">
    
        // searchable dropdown
    $('.select2').select2();

        new window.JustValidate('.js-form', {
        rules: {
            topic: {
                required: true
            },
            image: {
                required: true
            },
            excerpt: {
                required: true
            },
            description: {
                required: true
            },
        },
        messages: {
            topic: {
                required: 'Topic is required',
            },
            image: {
                required: 'Featured Image is required',
            },
            excerpt: {
                required: 'Excerpt is required',
            },
            description: {
                required: 'Description is required',
            },
        },
    });
</script>
@endsection
