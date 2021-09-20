@extends('admin.layouts.app')

@section('title', 'Add User')

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
                                            <h6 class="card-title">{{(isset($user)) ? 'Update' : 'Add'}} User </h6>
                                            <div class="header-elements">
                                                <div class="list-icons">
                                                    <a class="list-icons-item" data-action="collapse"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                             <form class="js-form" method="POST" action="{{ route('users.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('name','Name') }}<span style="color:red;">*</span>

                                                        <input type="text" name="name" placeholder="Enter Full Name" data-validate-field="name" style="margin-bottom:10px;" id="name" class="form-control" value="{{old('name')}}">

                                                        {!! $errors->first('name', '<label id="name-error" class="error" for="name">:message</label>') !!}
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('username','Username') }}<span style="color:red;">*</span>

                                                        <input type="text" name="username" placeholder="Enter Username" data-validate-field="username" style="margin-bottom:10px;" id="username" class="form-control" value="{{old('user')}}">

                                                        {!! $errors->first('username', '<label id="username-error" class="error" for="username">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('phone','Phone') }}<span style="color:red;">*</span>

                                                        <input type="text" name="phone" placeholder="Enter Phone Number"  style="margin-bottom:10px;" id="phone" class="form-control" value="{{old('phone')}}" data-validate-field="phone">

                                                        {!! $errors->first('phone', '<label id="name-error" class="error" for="name">:message</label>') !!}
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('email','Email') }}<span style="color:red;">*</span>
                                                        {{ Form::email('email',old('email'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Email Address'  , 'data-validate-field' => 'email')) }}
                                                        {!! $errors->first('email', '<label id="email-error" class="error" for="email">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('dob','DOB') }}<span style="color:blue;"> &nbsp; (optional)</span>

                                                        <input type="date" name="dob" placeholder="Enter DOB"  style="margin-bottom:10px;" id="dob" class="form-control" value="{{old('dob')}}">

                                                        {!! $errors->first('dob', '<label id="dob-error" class="error" for="dob">:message</label>') !!}
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('gender','Choose Gender') }}<span style="color:blue;"> &nbsp; (optional)</span>

                                                        <select name="gender" class="form-control">
                                                            <option value="">Choose Gender</option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                            <option value="other">Other</option>
                                                        </select>

                                                        {!! $errors->first('gender', '<label id="gender-error" class="error" for="gender">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('country','Country') }}<span style="color:blue;"> &nbsp; (optional)</span>

                                                        <input type="text" name="country" placeholder="Enter Country"  style="margin-bottom:10px;" id="country" class="form-control" value="{{old('country')}}">

                                                        {!! $errors->first('country', '<label id="country-error" class="error" for="country">:message</label>') !!}
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('city','City') }}<span style="color:blue;"> &nbsp; (optional)</span>

                                                        <input type="text" name="city" placeholder="Enter City"  style="margin-bottom:10px;" id="city" class="form-control" value="{{old('city')}}">

                                                        {!! $errors->first('city', '<label id="city-error" class="error" for="city">:message</label>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('address','Address') }}<span style="color:blue;"> &nbsp; (optional)</span>
                                                        <input type="text" name="address" placeholder="Enter Address" data-validate-field="address" style="margin-bottom:10px;" id="address" class="form-control" value="{{old('address')}}">
                                                        {!! $errors->first('address', '<label id="email-error" class="error" for="email">:message</label>') !!}
                                                    </div>
                                                </div>
                                                <div class="col m-auto">
                                                    <div class="form-group">
                                
                                                        <input type="checkbox" name="make_admin" class=""> Make Admin
                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        {{ Form::label('photo','User Image') }}<span style="color:blue;"> &nbsp; (optional)</span>
                                                        {{ Form::file('photo',array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Select Image')) }}
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
                                            <div class="d-flex justify-content-end align-items-center">
                                                <button type="submit" class="btn bg-blue ml-3">
                                                Save </button>
                                            </div>
                                            </form>
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
    
        // searchable dropdown
    $('.select2').select2();

        new window.JustValidate('.js-form', {
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true,
            },
            username: {
                required: true
            },
            phone: {
                required: true
            },
        },
        messages: {
            name: {
                required: 'User name is required',
            },
            email: {
                required: 'Email is required',
                email: 'Please enter a valid email address',
            },
            username: {
                required: 'Username is required',
            },
            phone: {
                required: 'Phone Number is required',
            },
        },
    });
</script>
@endsection
