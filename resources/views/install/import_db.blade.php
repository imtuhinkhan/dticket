@extends('install.layout')
@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="mar-ver pad-btm text-center">
                            <h1 class="h3">Database setup</h1>
                            <p>Update .env file with valid database credentials</p>
                        </div>

                        @if (isset($error))
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-12">
                              <div class="alert alert-danger">
                                <strong>Invalid Database Credentials!! </strong>Please check your database credentials carefully
                              </div>
                            </div>
                          </div>
                          @else
                          <div class="row" style="margin-top: 20px;">
                            <div class="col-md-12">
                              <div class="success alert-success" style="padding: 10px;text-align: center;">
                                <strong> Database Connected Successfully. </strong>
                              </div>
                            </div>
                          </div>

                        <p class="text-muted font-13" style="padding: 10px;text-align: center;">
                            <a href="{{url('/')}}/installtion/upload-sql" class="btn btn-success">Import SQL</a>
                        </p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
