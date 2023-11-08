@extends('layouts.app')
@section('title')
    <title>Companies | Create</title>
@endsection
@section('css')
    
@endsection
@section('content')
    @if (session('error'))
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <p class="mb-0">{{ session('error') }}</p>
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <p class="mb-0">{{ session('success') }}</p>
    </div>
    @endif
    <div class="card card-default color-palette-box">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-landmark"></i>
            Companies
          </h3>
            
        </div>
        <div class="card-body">
            <form action="{{route('companies.store')}}" method="post" id="addNewForm" enctype="multipart/form-data">@csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-12 col-xs-12">
                        <x-forms.input class="form-control {{ $errors->has('company_name') ? ' is-invalid' : '' }}" title="Company name" name="company_name" id="company_name" type="text" required="True"/>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-12 col-xs-12">
                        <x-forms.input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" title="Email" name="email" id="email" type="email" required="True"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-12 col-xs-12">
                        <x-forms.input class="form-control {{ $errors->has('logo') ? ' is-invalid' : '' }}" title="Logo" name="logo" id="logo" type="file" required="False"/>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-12 col-xs-12">
                        <x-forms.input class="form-control {{ $errors->has('website') ? ' is-invalid' : '' }}" title="Website" name="website" id="website" type="text" required="False"/>
                    </div>
                </div>
                <button type="submit" class="btn btn-info" style="float:right;">Save</button>
            </form>
        </div>
        <!-- /.card-body -->
    </div><br>
@endsection
@section('scripts')
        <!-- jquery-validation -->
        <script src="{{asset('admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
        <script src="{{asset('admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
        <script>
            $(function () {
                $('#addNewForm').validate({
                    rules: {
                        company_name: {
                            required: true
                        },
                        email: {
                            required: true
                        },
                    },
                    messages: {
                        company_name: {
                            required: "Please enter the company name"
                        },
                        email: {
                            required: "Please enter the email"
                        },
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    }
                });
            });
        </script>
    @endsection
