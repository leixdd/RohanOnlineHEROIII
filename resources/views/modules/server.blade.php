@extends('templates.IndexTemplate')

@section('title') ROHAN WORLD | Server @endsection

@section('content')

    <div class="d-flex justify-content-center mb-5">
        <div class="container bg-white col-6">

            <h2 class="pt-3"><i class="fa fa-database theme-text-color">&nbsp;</i>Server Information</h2>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-header bg-dark text-warning"><i class="fa fa-dashboard">&nbsp;</i> Server</div>
                        <div class="card-body">
                            <ul class="list-group" style="font-size: 10pt;">
                                <li class="list-group-item d-flex justify-content-between"><b>Server Status: </b><span class="badge badge-success">ACTIVE</span></li>
                                
                            </ul>

                            <hr>

                            <ul class="list-group" style="font-size: 10pt;">
                                <li class="list-group-item d-flex justify-content-between"><b>EXP and Drops: </b>HIGH to MID Server</li>
                                <li class="list-group-item d-flex justify-content-between"><b>Crones: </b>Flatrate</li>
                                <li class="list-group-item d-flex justify-content-between"><b>Server Type: </b>PVP/PVE</li>
                                <li class="list-group-item d-flex justify-content-between"><b>Server Version: </b>Hero III</li>
                                <li class="list-group-item d-flex justify-content-between"><b>Level Cap: </b>Level 115</li>
                                <li class="list-group-item d-flex justify-content-between"><b>No Trinity Class</b></li>
                                
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card mb-3">
                        <div class="card-header bg-dark text-warning"><i class="fa fa-wrench">&nbsp;</i> Forge Rate</div>
                        <div class="card-body">
                            <ul class="list-group" style="font-size: 13pt;">
                                <li class="list-group-item d-flex justify-content-between"><b>Rare: </b><span class="badge badge-success">90%</span></li>
                                <li class="list-group-item d-flex justify-content-between"><b>Unique: </b><span class="badge badge-success">80%</span></li>
                                <li class="list-group-item d-flex justify-content-between"><b>Ancient: </b><span class="badge badge-success">60%</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-dark text-warning"><i class="fa fa-diamond">&nbsp;</i> Rate Reinforce :  Accessories</div>
                        <div class="card-body">
                            ~+1-15=100% <br>
                            ~+16 =80% <br>
                            ~+17 = 75%<br>
                            ~+18 = 70%<br>
                            ~+19 = 65%<br>
                            ~+20 = 60%<br>
                            ~+21-22 = 50%<br>
                            ~+23-24 = 40%<br>
                            ~+25 = 30%<br>
                            ~+26-28 = 20%<br>
                            ~+29-30 = 10%<br>
                            
                        </div>
                    </div>

                     <div class="card mb-3">
                        <div class="card-header bg-dark text-warning"><i class="fa fa-diamond">&nbsp;</i> Rate Reinforce : Weapons / Armors</div>
                        <div class="card-body">
                            ~+1-17 = 100% <br>
                            ~+18-21 = 70%<br>
                            ~+22-25 = 50%<br>
                            ~+26-28 = 30%<br>
                            ~+29-30 = 20%<br>

                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>

@endsection