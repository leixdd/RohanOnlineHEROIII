@extends('templates.IndexTemplate')

@section('title') ROHAN WORLD | Item Mall @endsection


@section('content')
    <div class="container bg-white">

        <h2 class="pt-3"><i class="fa fa-shopping-cart theme-text-color">&nbsp;</i>ITEM MALL [ {{$type_name}} ] </h2>
        <h5><i>Current User Points: <b class="text-danger">{{ $up }}</b></i></h5>        

        <hr>

        <div class="btn-group d-flex justify-content-center pt-3 pb-2" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-secondary" href="/ItemMall/">All Items</a>
            <a type="button" class="btn btn-secondary" href="/ItemMall/1_GrowthxandxBuffs">Growth and Buffs</a>
            <a type="button" class="btn btn-secondary" href="/ItemMall/2_Forging">Forging</a>
            <a type="button" class="btn btn-secondary" href="/ItemMall/3_Convenience">Convenience</a>
            <a type="button" class="btn btn-secondary" href="/ItemMall/4_OptionxStones">Option Stones</a>
            <a type="button" class="btn btn-secondary" href="/ItemMall/5_Talismans">Talismans</a>
            <a type="button" class="btn btn-secondary" href="/ItemMall/6_Costumes">Costumes</a>
            <a type="button" class="btn btn-secondary" href="/ItemMall/7_PetsxandxMounts">Pets and Mounts</a>
            <a type="button" class="btn btn-secondary" href="/ItemMall/8_Package">Package</a>
        </div>

        
        <div class="row">
            <div class="col-lg-12">

                <div class="table-responsive">
                    <table class="table mt-3">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col"></th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Item Desc</th>
                            <th scope="col">Item Quantity</th>
                            <th scope="col">Item Price</th>
                            <th scope="col"></th>
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
                                    <td><button item-q="{{ $i->Item_Quantity }}"" item-name="{{$i->Item_Name}}" item-id="{{$i->id}}" class="btn bg-dark theme-text-color btn-purchase" onclick="PurchaseClick(this)"><span class="fa fa-shopping-cart">&nbsp;</span> Purchase</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection