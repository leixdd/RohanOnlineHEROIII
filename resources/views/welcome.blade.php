@extends('templates.IndexTemplate')


@section('title') ROHAN WORLD | Welcome @endsection


@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-9">
                <div class="jumbotron justify-content-center">
                    <img src="{{ asset('images/banner.png') }}" class="rounded img-thumbnail"/> <br>
                    <div class="text-center">
                        <br><br>
                        <i>
                     Our team aims to provide the most fair and clean Rohan experience possible.<br>
                     No ignorant staffs, bugged items, cheats and bugs. <br>
                     Prepare yourself and stay tuned for the ultimate Rohan experience.</i></div>
                </div>
                <div class="card">
                    <div class="card-header text-warning bg-dark">News &amp; Announcements</div>
                    <div class="card-body">
                        <div class="list-group">
                            @if($cms)
                                @foreach($cms as $c) 
                                    <a href="/news/{{STR_ENC::exec('encrypt', $c->id )}}" class="list-group-item list-group-item-action">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="mb-1">{{ $c->post_title }}</h5>
                                            <small>{{ $c->created_at }}</small>
                                        </div>
                                        <small>Posted by: Game Master</small>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                
                <div class="card mb-3">
                    <div class="card-header bg-dark text-warning"><i class="fa fa-dashboard">&nbsp;</i> Server Information</div>
                    <div class="card-body">
                        <ul class="list-group" style="font-size: 10pt;">
                            <li class="list-group-item d-flex justify-content-between"><b>Server Status: </b><span class="badge badge-success">ACTIVE</span></li>
                            <li class="list-group-item d-flex justify-content-between"><b>Registered Users: </b><span class="badge badge-success">{{ $regUsers }}</span></li>
                            <li class="list-group-item d-flex justify-content-between"><b>Current Online: </b><span class="badge badge-success">{{ $cLogins }}</span></li>
                            
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
                    <div class="card-header bg-dark text-warning"><i class="fa fa-wrench">&nbsp;</i> Social Link</div>
                    <div class="card-body">
                        <ul class="list-group" style="font-size: 13pt;">
                            <li class="list-group-item"><a href="https://discord.gg/Kpa5Gu4" target="_blank"><b>Discord </b></a></li>
                            <li class="list-group-item"><a href="https://www.facebook.com/rohanworldserver" target="_blank"><b>Facebook Page</b></a></li>
                            <li class="list-group-item"><a href="https://www.facebook.com/groups/1991414824264501/" target="_blank"><b>Facebook Group</b></a></li>
                            <li class="list-group-item"><a href="https://www.elitepvpers.com/" target="_blank"><b>Elitepvpers</b></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Button trigger modal -->
    <button id="modalx" hidden type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Rohan World ToS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-black">
                        Rohan: WORLD (referred to as us or we) is an Online Gaming Private Server under World Gaming Community. We operate the website www.rohanworld.com (the Website). These are the Terms and Conditions which govern each use you make of the donation payment services provided through the Website.
                        These Terms and Conditions apply separately to each single donation that you make. By confirming on the Website that you wish to make a donation you agree to be bound by these Terms and Conditions for that donation.
                        <br><br><br>
                        (1) <b>The donation services</b><br>
                        We will use your donation at our discretion and to support the server in every month expenses.
                        All payments through the Website are to be made by Paymaya, CoinsPH, BANK TRANSFERS, PAYPAL, and Money Transfers. Please note that we only accept payment by cash if handed to a Rohan World employee, from whom you will in return receive a receipt.
                        Once you confirm to us through the Website that you wish to proceed with your donation your transaction will be processed through our payment services provider, like Paypal. By confirming that you wish to proceed with your donation you authorize us to request funds from your chosen Payment Option like paypal, paymaya, coinsPH, credit or debit card provider.
                        <br><br><br>
                        (2) <b>Unauthorized card use</b><br>
                        If you become aware of fraudulent use of your card, or if it is lost or stolen, you must notify your card provider within 24 hours, not us because we are not responsible for the loss of your card.
                        <br><br><br>
                        (3) <b>Information from you</b><br>
                        Before we can process a donation you must provide us with (i) your name, address and email address; and facebook account where our employee will contact you to provide us the said information. It is your responsibility to ensure you have provided us with the correct information.
                        We won’t share your personal details with any other third party other than is set out in our Privacy Policy. Our Privacy Policy forms part of these Donation Payment Terms and Conditions and by agreeing to these Terms and Conditions you are also agreeing to the way we use and protect your personal information in line with our Privacy Policy.
                        <br><br><br>
                        (4) <b>Refund policy</b><br>
                        All refunds made after 24 hours of donation will be non refundable.
                        We assure you that before donating to us, the items you wish to be as our token of appreciation will be ready and will be released before payment. 
                        When we receive your payment in any of our payment option, it means that you already received your item prior before payment. 
                        If you make an error in your donation please contact us either by email at rohanworldgmteam@gmail.com or by messaging us at our official page www.facebook.com/rohanworldserver within 24hours and full refund will be made to you. Otherwise, all refund will be invalid.
                        <br><br><br>
                        (5)<b>General</b><br>
                        We reserve the right to amend these Donation Payment Terms and Conditions at any time.
                        These Donation Payment Terms and Conditions are governed by Philippines law and are subject to the exclusive jurisdiction of the Local courts.
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Agree</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Disagree</button>
                </div>
            </div>
        </div>
    </div>


@endsection