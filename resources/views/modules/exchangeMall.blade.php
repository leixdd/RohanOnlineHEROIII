@extends('templates.IndexTemplate')

@section('title') ROHAN WORLD | Item Mall @endsection


@section('content')
    <div class="container">


        <h2 class="pt-3 text-white"><i class="fa fa-shopping-cart theme-text-color ">&nbsp;</i>EXCHANGE MALL [ {{$type_name}} ] </h2>
        <h5 class="text-white"><i>Current User Points: <b class="text-danger">{{ $up }}</b></i></h5>        

        <hr>

        
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-5">
                    <div class="card-header text-warning bg-dark">Characters on Exchange Market</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mt-3">
                                <thead class="thead-dark">
                                    <tr>
                                    <th scope="col">Level</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Class</th>
                                    <th>K / D</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Seller</th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($SellingChars as $r) 
                                        <tr>
                                            <td>{{ $r->Char_level }}</td>
                                            <td>{{ $r->Char_name }}</td>
                                            <td> <img src="{{ asset('/classes/' . $r->Char_type . '.gif') }}"/> &nbsp; {{ $r->Char_class }}</td>
                                            <td> <span class="badge badge-success">{{ $r->Char_kill_count }}</span> / <span class="badge badge-danger">{{ $r->Char_killed_count }}</span> </td>
                                            <td>{{ $r->Char_Price }} RPs</td>
                                            <td><p style="width: 200px; word-wrap: break-word;">{{ $r->Char_Description }}</p></td>
                                            <td>{{ Helpers::getSeller($r->Char_Seller) }}</td>
                                            <td>
                                                <button item-name="{{ $r->Char_name }}" chc0x02="{{ STR_ENC::exec('encrypt', $r->Char_id) }}" class="btn bg-dark text-warning btn-sm" onclick="buyChar(this)"><span class="fa fa-shopping-cart">&nbsp;</span>Buy</button>
                                            </td>
                                            <!-- //TODO: Fix Ajax events  + Purchase -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection