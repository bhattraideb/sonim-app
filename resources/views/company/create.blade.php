@extends('layouts.master')
@section('pageTitle', 'Add Company')

@section('content')
    <div class="jumbotron">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    @include('partials._flash_message')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Add Company</h3>
                            <div class="float-right">
                                <a class="float-right btn btn btn-info btn-md" href="{{ route('companies.list')  }}">
                                    Company List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                {{ Form::open(['url' => route('company.store'),
                                    'enctype' => 'multipart/form-data',
                                    'method' => 'POST',
                                    'name' => 'frm_add',])
                                }}
                                <div class="form-group col-md-12 ">
                                    <label for="title">Name:</label><br>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" class="form-control">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-12 ">
                                    <label for="email">Email:</label><br>
                                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" class="form-control">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-12 ">
                                    <label for="address">Address:</label><br>
                                    <input type="text" name="address" id="title" class="form-control" value="{{ old('address') }}" class="form-control">
                                    @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-12 ">
                                    <label for="contact_number">Contact Number:</label><br>
                                    <input type="text" name="contact_number" id="title" class="form-control" value="{{ old('contact_number') }}" class="form-control">
                                    @if ($errors->has('contact_number'))
                                        <span class="text-danger">{{ $errors->first('contact_number') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">Status:</label><br>
                                    <input type="radio" name="status" id="status" value="active" class="form-control">Active
                                    <input type="radio" name="status" id="status" value="inactive" class="form-control">Inactive
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                                <div class="form-group" class="form-control">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-plus"></i> Save
                                        </button>
                                    </div>
                                </div>

                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
