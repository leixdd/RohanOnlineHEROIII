<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid ">
        <a class="navbar-brand theme-text-color" href="/">ROHAN WORLD</a>
        <button class="navbar-toggler" 

                type="button" 

                data-toggle="collapse" 

                data-target="#navbarRight" 

                aria-controls="navbarRight" 

                aria-expanded="false" 

                aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarRight">

            <ul class="navbar-nav">

                @if(CusAuth::user()) 
                    <li class="nav-item"> <a class="nav-link" id="prof" href="/User/profile"><i class="fa fa-user">&nbsp;</i>Player Control Panel</a> </li> 
                    @if(CusAuth::user()->grade == 250) <li class="nav-item"> <a class="nav-link" id="admin" href="/nqzvacnaryuneevwnaf/vgrzznantr"><i class="fa fa-group">&nbsp;</i>Admin Panel</a> </li> @endif
                @endif
                
                <li class="nav-item"> <a class="nav-link" id="Rewards" href="/Rewards"><i class="fa fa-gift">&nbsp;</i>Rewards</a></li>
                <li class="nav-item"> <a class="nav-link" id="im" href="#"><i class="fa fa-shopping-cart">&nbsp;</i>Item Mall</a> </li>
                <li class="nav-item"> <a class="nav-link" id="about" href="/ranking"><i class="fa fa-list">&nbsp;</i>Ranking</a> </li>
                <li class="nav-item"> <a class="nav-link" id="exm" href="#"><i class="fa fa-building">&nbsp;</i>Exchange Mall</a> </li>
                <li class="nav-item"> <a class="nav-link" id="server" href="/server"><i class="fa fa-database">&nbsp;</i>Server Information</a> </li>
                <li class="nav-item"> <a class="nav-link" id="downloads" href="/downloads"><i class="fa fa-download">&nbsp;</i>Downloads</a> </li>
                <li class="nav-item"> <a class="nav-link" id="Donate" href="/donate"><i class="fa fa-diamond">&nbsp;</i>Donate</a> </li>
                     
            </ul>
            <ul class="navbar-nav ml-auto">
            
            @if(!CusAuth::user())
                    
                <li class="nav-item"> <a class="nav-link" id="reg" href="/registration"><i class="fa fa-user-plus">&nbsp;</i>Sign Up</a> </li>
                <li class="nav-item"> &nbsp;</li>
            
            @endif
            
                <li class="nav-item">
                    @if(!CusAuth::user())
                    <div class="btn-group">

                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-pencil">&nbsp;</i> Sign In
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">

                            <h6 class="dropdown-header bg-dark text-white">Hey! Welcome, You could login here</h6>

                            <div class="dropdown-divider"></div>

                            <div class="form-inline p-2">


                                <div class="form-group col-lg-12">

                                    <label for="username">Username</label>

                                    <input type="text" name="email" id="username" class="form-control" required validate/>

                                </div>

                                <div class="form-group col-lg-12">

                                    <label for="password">Password</label>

                                    <input type="password" name="password" id="passwordLogin" class="form-control" required validate/>

                                </div>

                            </div>

                            <div class="dropdown-divider"></div>

                            <button type="submit" id="btnLog" class="form-control btn btn-md text-white bg-dark col-lg-12 ld-ext-right"><span class="subMes">Login</span><div class="ld ld-ring ld-spin ld-spin-fast"></div></button>

                            <br>

                            <center>
                                <i><small>No Account? Register <a class="theme-text-color" id="registerLink" href="/registration">Here</a></small></i>
                            </center>

                        </div>

                    </div>
                    @else

                    <div class="btn-group">

                        <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!-- ${sessionScope.user_uname} -->
                            {{ CusAuth::user()->login_id }}
                        </button>

                        <div class="dropdown-menu dropdown-menu-right">

                            <h6 class="dropdown-header bg-dark text-white">Hey! Welcome</h6>

                            <div class="dropdown-divider"></div>

                            <ul class="list-group">
                                <li class="list-group-item" id="viewProfile"><a href="/User/profile" style="text-decoration: none">View Profile</a></li>
                                <li class="list-group-item" id="logout" 
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</li>
                            </ul>
                        </div>

                    </div>
                    
                    @endif

                </li>
            
            </ul>

        </div>    

    </div>

</nav>

<form id="logout-form" action="{{ url('/User/logout') }}" method="POST" style="display: none;">

{{ csrf_field() }}

</form>