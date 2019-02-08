@extends('templates.IndexTemplate')

@section('title') ROHAN WORLD | Sign In @endsection

@section('content')

    <div class="d-flex justify-content-center mb-5">
        <div class="container bg-white col-6">

            <h2 class="pt-3"><i class="fa fa-pencil theme-text-color">&nbsp;</i>Sign In</h2>
            <hr>
            <div class="row">
                <div class="col-lg-12">

  
                    @if(Session::has('errorNE'))
                        <div class="alert alert-danger">
                            {{ Session::get('errorNE') }}
                        </div>
                    @endif
                    
                    <form action="/User/login" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" name="username" type="text" required/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" name="password" type="password" required/>
                        </div>

                        <hr>

                        <button class="mb-3 form-control btn btn-warning text-white" type="submit"><b>Submit</b></button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection