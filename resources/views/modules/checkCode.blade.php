@extends('templates.IndexTemplate')

@section('title') ROHAN WORLD | Account Confirmation @endsection

@section('content')

    <div class="d-flex justify-content-center mb-5">
        <div class="container bg-white col-6">

            <h2 class="pt-3"><i class="fa fa-check theme-text-color">&nbsp;</i>Account Confirmation</h2>
            <hr>
            <div class="row">
                <div class="col-lg-12">

  
                    @if(Session::has('errorNE'))
                        <div class="alert alert-danger">
                            {{ Session::get('errorNE') }}
                        </div>
                    @endif

                    <div class="alert alert-info">
                        <i>Confirmation code was sent to your email, Check your email and paste the code here!</i>
                    </div>

                    <form action="/User/confirmation" method="post">
                        @csrf

                        <div class="form-group">
                            <label>Confirmation Code:</label>
                            <input type="text" name="confirmcode" class="form-control" required />
                        </div>
                        <hr>

                        <button class="mb-3 form-control btn btn-warning text-white" type="submit"><b>Submit</b></button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection