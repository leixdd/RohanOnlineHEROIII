@extends('templates.IndexTemplate')

@section('title') ROHAN WORLD | Registration @endsection

@section('content')

    <div class="d-flex justify-content-center mb-5">
        <div class="container bg-white col-6">

            <h2 class="pt-3"><i class="fa fa-user-plus theme-text-color">&nbsp;</i>Registration</h2>
            <hr>
            <div class="row">
                <div class="col-lg-12">

  
                    @if(Session::has('errorNE'))
                        <div class="alert alert-danger">
                            {{ Session::get('errorNE') }}
                        </div>
                    @endif
                    
                    <form action="/registration" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" name="username" type="text" maxlength="20" required/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" name="password" type="password" required/>
                        </div>
                        <div class="form-group">
                            <label for="confirm_pass">Confirm Password</label>
                            <input class="form-control" name="confirm_pass" type="password" required/>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input class="form-control" name="email" type="email" required/>
                        </div>
                        <div class="form-group">
                            <label for="sp">Secret Password <i>(In Case of lockout)</i></label>
                            <input class="form-control" name="sp" type="password" required/>
                        </div>

                        <input class="form-control" name="inviCode" type="text" value="" hidden/>

                        <hr>

                        <button id="triggerSub" type="submit" class="mb-3 form-control btn btn-warning text-white ld-ext-right"><div class="ld ld-ring ld-spin ld-spin-fast"></div><span class="subMes"><b>Submit</b></span></button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection