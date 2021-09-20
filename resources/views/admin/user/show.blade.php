@extends('admin.layouts.app')

@section('title', 'User Details')

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
                                            <h6 class="card-title">User Details</h6>
                                            <div class="header-elements">
                                                <div class="list-icons">
                                                    <a class="list-icons-item" data-action="collapse"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                            	<div class="col-md-7">
                                            		<div class="row">
		                                                <div class="col-md-5">
		                                                	<h4 class="float-right">Full Name: </h4>
		                                                </div>
		                                                <div class="col">
		                                                	<h4>{{$user->name}}</h4>
		                                                </div>
		                                            </div>
		                                            <hr>
													<div class="row">
		                                                <div class="col-md-5">
		                                                	<h4 class="float-right">Username: </h4>
		                                                </div>
		                                                <div class="col">
		                                                	<h4>{{$user->username}}</h4>
		                                                </div>
		                                            </div>
		                                            <hr>
		                                            <div class="row">
		                                                <div class="col-md-5">
		                                                	<h4 class="float-right">Email: </h4>
		                                                </div>
		                                                <div class="col">
		                                                	@if($user->email != Null)
		                                                	<h4>{{$user->email}}</h4>
		                                                	@else
		                                                	<h4>No Email Address Yet!</h4>
		                                                	@endif
		                                                </div>
		                                            </div>
                                            	</div>
                                            	<div class="col-md-5">
                                            		@if($user->profile->photo != Null)
                                            		<img src="{{ $user->profile->photo }}" alt="User Image" width="50%" class="img-thumbnail float-right mr-4">

                                            		@else
														<h4 class="text-danger">No Image Uploaded Yet!</h4>
                                            		@endif
                                            	</div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                	<h4 class="float-right">Verification: </h4>
                                                </div>
                                                <div class="col">
                                                	@if($user->phone_verified_at != Null)
														<h4 class="text-success">Verified at: {{$user->phone_verified_at}}</h4>
                                                	@else
														<h4 class="text-danger">Not Verified Yet!</h4>
                                                	@endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                	<h4 class="float-right">Phone: </h4>
                                                </div>
                                                <div class="col">
                                                	@if($user->profile->phone != Null)
														<h4 class="text-success">
															{{$user->profile->phone}}
														</h4>
                                                	@else
														<h4 class="text-danger">No Phone Number Yet!</h4>
                                                	@endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4 class="float-right">Address: </h4>
                                                </div>
                                                <div class="col">
                                                	@if($user->profile->address != Null)
														<h4 class="text-success">
															{{$user->profile->address}}
														</h4>
                                                	@else
														<h4 class="text-danger">No Address Yet!</h4>
                                                	@endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4 class="float-right">Country: </h4>
                                                </div>
                                                <div class="col">
                                                	@if($user->profile->country != Null)
														<h4 class="text-success">
															{{$user->profile->country}}
														</h4>
                                                	@else
														<h4 class="text-danger">No Country Yet!</h4>
                                                	@endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                	<h4 class="float-right">City: </h4>
                                                </div>
                                                <div class="col">
                                                	@if($user->profile->city != Null)
														<h4 class="text-success">
															{{$user->profile->city}}
														</h4>
                                                	@else
														<h4 class="text-danger">No City Yet!</h4>
                                                	@endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                	<h4 class="float-right">Gender: </h4>
                                                </div>
                                                <div class="col">
                                                	@if($user->profile->gender != Null)
														<h4 class="text-success">
															{{$user->profile->gender}}
														</h4>
                                                	@else
														<h4 class="text-danger">No Gender Yet!</h4>
                                                	@endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                	<h4 class="float-right">Date of Birth: </h4>
                                                </div>
                                                <div class="col">
                                                	@if($user->profile->dob != Null)
														<h4 class="text-success">
															{{$user->profile->dob}}
														</h4>
                                                	@else
														<h4 class="text-danger">No DOB Yet!</h4>
                                                	@endif
                                                </div>
                                            </div>
                                            
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

@endsection
