@extends('templates.IndexTemplate')

@section('title') ROHAN WORLD | Edit Item @endsection

@section('content')

    <div class="d-flex justify-content-center mb-5">
        <div class="container bg-white col-10">

            <h2 class="pt-3"><i class="fa fa-user theme-text-color">&nbsp;</i>Update Item</h2>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header text-warning bg-dark"><i class="fa fa-diamond">&nbsp;</i>Update Item</div>
                        <div class="card-body">

                            <form id="frmIM">

                                <div class="form-group">
                                    <label for="ItemImage">Item Id</label>
                                    <input class="form-control" id="item_id" required value="{{ $item->Item_Id }}" disabled readonly/>
                                </div>

                                <div class="form-group">
                                    <label for="Category">Category</label>
                                    <select class="form-control" id="item_category" required>
                                        <option value="1" {{ $item->Item_Category == 1 ? 'selected' : '' }} >Growth and Buffs</option>
                                        <option value="2" {{ $item->Item_Category == 2 ? 'selected' : '' }}>Forging</option>
                                        <option value="3" {{ $item->Item_Category == 3 ? 'selected' : '' }} >Convenience</option>
                                        <option value="4" {{ $item->Item_Category == 4 ? 'selected' : '' }} >Option Stones</option>
                                        <option value="5" {{ $item->Item_Category == 5 ? 'selected' : '' }} >Talismans</option>
                                        <option value="6" {{ $item->Item_Category == 6 ? 'selected' : '' }} >Costumes</option>
                                        <option value="7" {{ $item->Item_Category == 7 ? 'selected' : '' }} >Pets and Mounts</option>
                                        <option value="8" {{ $item->Item_Category == 8 ? 'selected' : '' }} >Package</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="Packaging">Package Method</label>
                                    <select class="form-control" id="item_packaging" required>
                                        <option value="1" {{ $item->Item_Pack == 1 ? 'selected' : '' }}>Full Packed [No Stacks]</option>
                                        <option value="0" {{ $item->Item_Pack == 0 ? 'selected' : '' }}>Loose Packed [Will Stack]</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ItemImage">Item Image</label>
                                    <input class="form-control" id="item_image" required value="{{ $item->Item_Image }}" />
                                </div>
                            
                                <div class="form-group">
                                    <label for="ItemImage">Item Name</label>
                                    <input class="form-control" id="item_name" required value="{{ $item->Item_Name }}"/>
                                </div>
                                
                                <div class="form-group">
                                    <label for="ItemImage">Item Description</label>
                                    <input class="form-control" id="item_description" required value="{{ $item->Item_Description }}"/>
                                </div>
                                
                                <div class="form-group">
                                    <label for="ItemImage">Item Quantity</label>
                                    <input class="form-control" type="number" id="item_quantity" required value="{{ $item->Item_Quantity }}"/>
                                </div>
                                
                                <div class="form-group">
                                    <label for="ItemImage">Item Price</label>
                                    <input class="form-control" type="number" id="item_price" required value="{{ $item->Item_Price }}"/>
                                </div>
                                
                                <button id="saveBtn" class="form-control bg-dark text-warning" onclick="UpdateItem()">Update Item</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
