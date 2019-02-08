@extends('templates.IndexTemplate')

@section('title') ROHAN WORLD | Administrative @endsection

@section('content')

    <div class="d-flex justify-content-center mb-5">
        <div class="container bg-white col-10">

            <h2 class="pt-3"><i class="fa fa-user theme-text-color">&nbsp;</i>Administrative Panel</h2>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#itemMallEdit" id="itemMall-tab" aria-controls="itemMallE" aria-selected="true"> <i class="fa fa-shopping-cart ">&nbsp;</i> Item Mall Manage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#cms" id="cms-tab" aria-controls="CMS News" aria-selected="false"><i class="fa fa-clipboard">&nbsp;</i> CMS News</a>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="UserProfile">
                        <div class="tab-pane fade show active" id="itemMallEdit" role="tabpanel" aria-labelledby="itemMall-tab">
                            <div class="card">
                                <div class="card-header text-warning bg-dark"> Item Manage </div>
                                <div class="card-body">

                                    <div class="d-flex justify-content-between">
                                        <a href="/nqzvacnaryuneevwnaf/vgrzznantr/AddItem" class="btn btn-md text-warning bg-dark"><i class="fa fa-plus">&nbsp;|&nbsp;&nbsp;</i>Add new Item</a>
                                        <div>
                                            <form class="form-inline" method="post" action="/nqzvacnaryuneevwnaf/vgrzznantr/searchItem">
                                                @csrf
                                                <div class="form-group pr-2">
                                                    <input placeholder="Item ID" type="number" class="form-control input-md" name="id" />
                                                </div>
                                                <button type="submit" class="btn btn-md text-warning bg-dark form-control"><i class="fa fa-search">&nbsp;</i>Search</button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table mt-3">
                                            <thead class="thead-dark">
                                                <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Item Desc</th>
                                                <th scope="col">Item Quantity</th>
                                                <th scope="col">Item Price</th>
                                                <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($items as $i)
                                                    <tr>
                                                        <td><img src="{{ asset('icons/' . $i->Item_Image) }}" /></td>
                                                        <td  class="itemName">{{ $i->Item_Name }}</td>
                                                        <td>{{ $i->Item_Description }}</td>
                                                        <td>{{ $i->Item_Quantity }}</td>
                                                        <td>{{ $i->Item_Price }}</td>
                                                        <td><a href="/nqzvacnaryuneevwnaf/vgrzznantr/EditItem/{{$i->id}}" item-q="{{ $i->Item_Quantity }}"" item-name="{{$i->Item_Name}}" item-id="{{$i->id}}" class="btn bg-dark theme-text-color "><span class="fa fa-recycle">&nbsp;</span> Update</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="cms" role="tabpanel" aria-labelledby="cms-tab">
                            <div class="card">
                                <div class="card-header text-warning bg-dark">News &amp; Announcements</div>
                                <div class="card-body">
                                    <form id="frmCMS">

                                        <div class="form-group">
                                            <label for="ItemImage">Post Title</label>
                                            <input class="form-control" id="post_title" required />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="ItemImage">Post Description</label>
                                            <textarea class="form-control" id="post_description" required ></textarea>
                                        </div>
                                        
                                        <button class="btn text-warning bg-dark form-control">Post</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection