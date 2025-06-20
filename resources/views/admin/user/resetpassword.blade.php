@extends('admin.layout.default')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="text-capitalize fw-600 text-dark fs-4">{{trans('labels.reset_password')}}</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">{{trans('labels.vendors')}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('labels.reset_password')}}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card border-0 box-shadow">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="oldpass"
                                    class="form-label">{{trans('labels.current_password')}}<span class="text-danger"> * </span></label>
                                <input type="password" class="form-control" name="currentpassword" id="oldpass"
                                    placeholder="current password">
                            </div>
                            <div class="form-group">
                                <label for="newpass" class="form-label">{{trans('labels.new_password')}}<span class="text-danger"> * </span></label>
                                <input type="password" class="form-control" name="password" id="newpass"
                                    placeholder="new password">
                            </div>
                            <div class="form-group">
                                <label for="cfpass"
                                    class="form-label">{{trans('labels.confirm_password')}}<span class="text-danger"> * </span></label>
                                <input type="password" class="form-control" name="password confirmation" id="cfpass"
                                    placeholder="confirm password">
                            </div>
                            <button type="submit"
                                class="btn btn-secondary px-sm-4 mt-4">{{trans('labels.change_password')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection