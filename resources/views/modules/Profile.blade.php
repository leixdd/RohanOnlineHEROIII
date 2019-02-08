@extends('templates.IndexTemplate')

@section('title') ROHAN WORLD | Player Control Panel @endsection

@section('content')

    <div class="d-flex justify-content-center mb-5">
        <div class="container bg-white col-10">

            <h2 class="pt-3"><i class="fa fa-user theme-text-color">&nbsp;</i>Player Control Panel</h2>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                
                    @if(Session::has('SuccessMessage'))
                        <div class="alert alert-success">
                            {{ Session::get('SuccessMessage') }}
                        </div>
                    @endif

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#characters" id="char-tab" aria-controls="Characters" aria-selected="true"> <i class="fa fa-group ">&nbsp;</i> Characters</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#points" id="points-tab" aria-controls="Points" aria-selected="false"><i class="fa fa-diamond">&nbsp;</i> Points</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#exmX" id="exm-tab" aria-controls="Exchange" aria-selected="false"><i class="fa fa-exchange">&nbsp;</i> Exchanges</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#settings" id="settings-tab" aria-controls="Settings" aria-selected="false"><i class="fa fa-cogs">&nbsp;</i> Settings</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#invite" id="invite-tab" aria-controls="Invites" aria-selected="false"><i class="fa fa-recycle">&nbsp;</i> Invite</a>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="UserProfile">

                        <div class="tab-pane fade show active" id="characters" role="tabpanel" aria-labelledby="char-tab">
                            <div class="table-responsive">
                                <table class="table mt-3">
                                    <thead class="thead-dark">
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"></th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Experience</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">Kills</th>
                                        <th scope="col">Deaths</th>
                                        <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  $c = 1; ?>
                                        @foreach($Characters as $r) 
                                            <tr chc0x2="{{$r->id}}">
                                                <td> {{ $c++ }}</td>
                                                <td><img src="{{ asset('/classes/' . $r->ctype_id . '.gif') }}" /></td>
                                                <td style="{{ $r->pk_state == 3 ? 'color: red' : 'color: black' }}">{{ $r->name }}  <b class="text-danger">{{ $r->flag == 1 ? '[Sealed]' : ''}}</b></td>
                                                <td>{{ $r->Class }}</td>
                                                <td><span class="badge badge-primary">{{ $r->exp }}</span></td>
                                                <td>{{ $r->level }}</td>
                                                <td><span class="badge badge-danger">{{ $r->kill_count }}</span></td>
                                                <td><span class="badge badge-success">{{ $r->killed_count }}</span></td>
                                                <td>
                                                    @if($r->flag == 1) 
                                                        <button chc0x02="{{ STR_ENC::exec('encrypt', $r->id) }}" class="btn bg-dark text-warning btn-sm" onclick="unsealChar(this)"><span class="fa fa-cog">&nbsp;</span> Unseal this character</button>
                                                        <a class="btn bg-dark text-warning btn-sm" href="/User/sellingInformation/{{ STR_ENC::exec('encrypt', $r->id) }}"><span class="fa fa-cog">&nbsp;</span> Sell this character</a>
                                                    @else
                                                        <button chc0x02="{{$r->id}}" class="btn bg-dark text-warning btn-sm" onclick="fix5101(this)"><span class="fa fa-cog">&nbsp;</span> Fix 5101</button>
                                                        @if($r->pk_state == 3) 
                                                        <br>
                                                        <br>
                                                        <button chc0x02="{{ STR_ENC::exec('encrypt', $r->id) }}" class="btn bg-dark text-warning btn-sm" onclick="removeMS(this)"><span class="fa fa-close">&nbsp;</span> Remove Murderer Status</button>
                                                        @endif

                                                        @if($r->ctype_id == 197654) 
                                                        <br>
                                                        <br>
                                                        <button chc0x02="{{ STR_ENC::exec('encrypt', $r->id) }}" class="btn bg-dark text-warning btn-sm" onclick="RKI(this)"><span class="fa fa-crosshairs">&nbsp;</span> Ranger's Killing Intent</button>
                                                        @endif
                                                    @endif
                                                    <br>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="exmX" role="tabpanel" aria-labelledby="exm-tab">

                            <div class="card p-5">
                                <div class="card-header text-warning bg-dark">Characters on Exchange Market</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mt-3 text-center">
                                            <thead class="thead-dark">
                                                <tr>
                                                <th scope="col">#</th>
                                                <th scope="col"></th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Class</th>
                                                <th scope="col">Level</th>
                                                <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  $c = 1; ?>
                                                @foreach($SellingChars as $r) 
                                                    <tr chc0x2="{{$r->id}}">
                                                        <td> {{ $c++ }}</td>
                                                        <td><img src="{{ asset('/classes/' . $r->ctype_id . '.gif') }}" /></td>
                                                        <td>{{ $r->name }}  <b class="text-danger">{{ $r->flag == 1 ? '[Sealed]' : ''}}</b></td>
                                                        <td>{{ $r->Class }}</td>
                                                        <td>{{ $r->level }}</td>
                                                        <td>
                                                            <button chc0x02="{{ STR_ENC::exec('encrypt', $r->id) }}" class="btn bg-dark text-warning btn-sm" onclick="removeFromEX(this)"><span class="fa fa-close">&nbsp;</span> Remove this from Exchange Market</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="points" role="tabpanel" aria-labelledby="points-tab">
                            <div class="d-flex justify-content-between pl-5 pr-5 pt-5 pb-5">
                                <div class="">
                                    <h5>Current Points : {{ $points[0]->points }}</h5>
                                    <hr>
                                    <h5>Free Points : 0</h5>
                                </div>
                                <div class="">
                                    <a class="btn btn-lg bg-dark theme-text-color" href="/donate"><i class="fa fa-diamond">&nbsp;</i> Donate for Points</a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                            <div class="card mb-5">
                                <div class="card-header bg-dark theme-text-color">
                                    <h5>Change Password</h5>
                                </div>
                                <div class="card-body">
                                    <form id="frmChange">
                                        @csrf

                                        <div class="form-group">
                                            <label for="oldPass">Old Password</label>
                                            <input type="password" name="oldPass" class="form-control" id="op" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="newPass">New Password</label>
                                            <input type="password" name="newPass" class="form-control" id="np" required/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="confirmPass">Confirm Password</label>
                                            <input type="password" name="confirmPass" class="form-control" id="cp" required/>
                                        </div>

                                        <button id="btnChangePass" type="submit" class="btn bg-dark text-warning"><span class="fa fa-recycle">&nbsp;</span> Change Password</button>
                                    </form>    
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="quests" role="tabpanel" aria-labelledby="quests-tab">
                            <div class="card m-5">
                                <div class="card-header bg-dark theme-text-color">
                                    <h5>Quest Accessories</h5>
                                </div>
                                <div class="card-body">
                                    <form id="questAcce">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="characterSelect">
                                                    <b>Select Character</b> 
                                                    <br>
                                                    <small><i>Make sure that the character of your choice has all the materials inside of its bag. Also offlined Characters will be only seen here. If you don't see here your character, logout first or try to click FIX 5101</i></small>
                                                </label>
                                                <select id="characterSelect" name="characterSelect" class="form-control">
                                                    @foreach($gc as $g)
                                                        <option value="{{ STR_ENC::exec('encrypt', $g->id) }}">{{ $g->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="selectBossAccessories">
                                                    <b>Select Boss Accessories</b>
                                                    <br>
                                                    <small><i>Choose the Boss Ring that you want to pass</i></small>
                                                </label>
                                                <select id="selectBossAccessories" name="selectBossAccessories" class="form-control">
                                                    <option value="{{ STR_ENC::exec('encrypt', 2753116) }}">Eudrome's Ring</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2753117) }}">Eudrome's Bracer</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2753118) }}">Eudrome's Necklace</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2753088) }}">Wrath of Ancient Darkness</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2773659) }}">Bezemut's Eyes</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2773627) }}">Heart of Igseilt</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="selectQR">
                                                    <b>Select Quest Accessories</b>
                                                    <br>
                                                    <small><i>Choose the Quest Ring that you want to obtain</i></small>
                                                </label>
                                                <select id="selectQR" name="selectQR" class="form-control">
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813574) }}">[ASV] - Abyss Ring</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813575) }}">[ASV] - Abyss Bracelet</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813576) }}">[ASV] - Abyss Cuffs</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813577) }}">[ASV] - Abyss Necklace</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813578) }}">[IPV] - Zeus Ring</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813579) }}">[IPV] - Zeus Bracelet</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813580) }}">[IPV] - Zeus Cuffs</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813581) }}">[IPV] - Zeus Necklace</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813582) }}">[SDV] - Ares Ring</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813583) }}">[SDV] - Ares Bracelet</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813584) }}">[SDV] - Ares Cuffs</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813585) }}">[SDV] - Ares Necklace</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813586) }}">[ADV] - Hades Ring</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813587) }}">[ADV] - Hades Bracelet</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813588) }}">[ADV] - Hades Cuffs</option>
                                                    <option value="{{ STR_ENC::exec('encrypt', 2813589) }}">[ADV] - Hades Necklace</option>
                                                </select>
                                            </div>
                                            <button id="btnSubmitAcce" type="submit" class="btn bg-dark text-warning btn-md mt-3 ld-ext-right"><div class="ld ld-ring ld-spin ld-spin-fast"></div><span class="subMes"><i class="fa fa-diamond">&nbsp;</i> Get your Quest Accessories</span></button>
                                        </div>
                                        
                                    </form>    
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="invite" role="tabpanel" aria-labelledby="invite-tab">
                            <div class="row">
                                <div class="col-4">
                                    <div class="card m-5">
                                        <div class="card-header bg-dark theme-text-color">
                                            <h5>Invite your Friends</h5>
                                        </div>
                                        <div class="card-body" id="bodyCard">
                                            @if(!$referral_link) 
                                                <button id="btnGenerate" class="btn bg-dark text-warning btn-lg mt-3 ld-ext-right"><div class="ld ld-ring ld-spin ld-spin-fast"></div><span class="subMes"><i class="fa fa-diamond">&nbsp;</i> GENERATE REFERRAL LINK</span></button>
                                            @else 
                                                <form>
                                                    <div class="form-group">
                                                        <label><b>Your Invitation Code is</b></label>
                                                        <textarea type="text" class="form-control" readonly="true" style="height: 200px">{{ $referral_link[0]->generated_link }}</textarea>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="card mt-5">
                                        <div class="card-header bg-dark theme-text-color">
                                            <h5>Invited Friends</h5>
                                        </div>
                                        <div class="card-body" id="bodyCard">
                                            @if($referrals)
                                            <div class="table-responsive">
                                                <table class="table mt-3">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Username</th>
                                                        <th scope="col">Registration Date</th>
                                                        <th scope="col">Total Max Level Characters</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  $c = 1; ?>
                                                        @foreach($referrals as $r)
                                                            <tr>
                                                                <td> {{ $c++ }}</td>
                                                                <td>{{ $r->login_id }}</td>
                                                                <td>{{ date('d-M-Y', strtotime($r->created_at)) }}</td>
                                                                <td>{{ $r->char110 }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            @else
                                                No Accounts Currently Invited
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
 
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modelRewards" tabindex="-1" role="dialog" aria-labelledby="modelRewardsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">List of Rewards</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table mt-3">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Reward Name</th>
                            <th scope="col">Reward</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="model-table-body">
                            <tr>
                                <td>1</td>
                                <td><b>Welcome to the RW</b> [ Successfull Invitation ]</td>
                                <td>[Coming Soon]</td>
                                <td><button class="btn bg-dark text-warning btn-sm" onclick="" data-toggle="modal" data-target="#modelRewards"><span class="fa fa-gift">&nbsp;</span> Get Reward</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><b>Comet Start</b> [ First Max Level ]</td>
                                <td>[Coming Soon]</td>
                                <td><button class="btn bg-dark text-warning btn-sm" onclick="" data-toggle="modal" data-target="#modelRewards"><span class="fa fa-gift">&nbsp;</span> Get Reward</button></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><b>Addict</b> [ 4 Max Levels ]</td>
                                <td>[Coming Soon]</td>
                                <td><button class="btn bg-dark text-warning btn-sm" onclick="" data-toggle="modal" data-target="#modelRewards"><span class="fa fa-gift">&nbsp;</span> Get Reward</button></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><b>Assassin</b> [ 20 Kills ] </td>
                                <td>[Coming Soon]</td>
                                <td><button class="btn bg-dark text-warning btn-sm" onclick="" data-toggle="modal" data-target="#modelRewards"><span class="fa fa-gift">&nbsp;</span> Get Reward</button></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><b>No Mercy</b> [ 75 Kills ] </td>
                                <td>[Coming Soon]</td>
                                <td><button class="btn bg-dark text-warning btn-sm" onclick="" data-toggle="modal" data-target="#modelRewards"><span class="fa fa-gift">&nbsp;</span> Get Reward</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
@endsection