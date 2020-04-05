@extends('layouts.master')
@section('pageTitle', 'Update Admin')

@section('content')
    <div class="jumbotron">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    @include('partials._flash_message')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Update Admin</h3>
                            <div class="float-right">
                                <a class="float-right btn btn btn-info btn-md" href="{{ route('admin.list')  }}">
                                    Company List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                {{ Form::open(['url' => route('admin.update'),
                                    'method' => 'POST',
                                    'name' => 'frm_add',])
                                }}

                                <div class="form-group col-md-12 ">
                                    <label for="company_id">Company:</label>
                                    <select name="company_id" class="browser-default custom-select">
                                        <option value="">--Select Company--</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" @if($admin->company_id == $company->id) selected @endif>{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('company_id'))
                                        <span class="text-danger">{{ $errors->first('company_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-12 ">
                                    <label for="title">Name:</label><br>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $admin->name }}" class="form-control">
                                    <input type="hidden" name="admin_id" id="admin_id" value="{{ $admin->id }}" class="form-control">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-12 ">
                                    <label for="email">Email:</label><br>
                                    <input type="text" name="email" id="email" class="form-control" value="{{ $admin->email }}" class="form-control">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-12 ">
                                    <label for="contact_number">Contact Number:</label><br>
                                    <input type="text" name="contact_number" id="title" class="form-control" value="{{ $admin->contact_number }}" class="form-control">
                                    @if ($errors->has('contact_number'))
                                        <span class="text-danger">{{ $errors->first('contact_number') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">Status:</label><br>
                                    <input type="radio" name="status" id="status" value="active" class="form-control" @if($admin->status == 'active') checked @endif>Active
                                    <input type="radio" name="status" id="status" value="inactive" class="form-control" @if($admin->status == 'inactive') checked @endif>Inactive
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
