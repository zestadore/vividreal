@extends('layouts.app')
@section('title')
    <title>Employees | Create</title>
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
            Employees
          </h3>
            
        </div>
        <div class="card-body">
            <form action="{{route('employees.store')}}" method="post" id="addNewForm">@csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-12 col-xs-12">
                        <x-forms.input class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" title="First name" name="first_name" id="first_name" type="text" required="True"/>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-12 col-xs-12">
                        <x-forms.input class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" title="Last name" name="last_name" id="last_name" type="text" required="True"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-md-12 col-xs-12">
                        <label for="company_id">Company <span style="color:red;">*</span></label>
                        <select name="company_id" id="company_id" class="form-control" required>
                            <option value="">Select Company</option>
                            @foreach ($companies as $item)
                                <option value="{{$item->id}}">{{$item->company_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-12 col-xs-12">
                        <x-forms.input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" title="Email" name="email" id="email" type="email" required="False"/>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-12 col-xs-12">
                        <x-forms.input class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" title="Phone" name="phone" id="phone" type="text" required="False"/>
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
                        first_name: {
                            required: true
                        },
                        last_name: {
                            required: true
                        },
                        company_id: {
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
