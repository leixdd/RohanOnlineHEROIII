@extends('templates.IndexTemplate')

@section('title') ROHAN WORLD | Add Item @endsection

@section('content')

    <div class="d-flex justify-content-center mb-5">
        <div class="container bg-white col-10">

            <h2 class="pt-3"><i class="fa fa-user theme-text-color">&nbsp;</i>New item</h2>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header text-warning bg-dark"><i class="fa fa-diamond">&nbsp;</i>New Item</div>
                        <div class="card-body">

                            <form id="frmIM">
                                <div class="form-group">
                                    <label for="Category">Category</label>
                                    <select class="form-control" id="item_category" required>
                                        <option value="1">Growth and Buffs</option>
                                        <option value="2">Forging</option>
                                        <option value="3">Convenience</option>
                                        <option value="4">Option Stones</option>
                                        <option value="5">Talismans</option>
                                        <option value="6">Costumes</option>
                                        <option value="7">Pets and Mounts</option>
                                        <option value="8">Package</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="Packaging">Package Method</label>
                                    <select class="form-control" id="item_packaging" required>
                                        <option value="1">Full Packed [No Stacks]</option>
                                        <option value="0">Loose Packed [Will Stack]</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ItemImage">Item Image</label>
                                    <input class="form-control" id="item_image" required />
                                </div>
                                
                                <div class="form-group">
                                    <label for="ItemImage">Item Id</label>
                                    <input class="form-control" id="item_id" required />
                                </div>
                                
                                <div class="form-group">
                                    <label for="ItemImage">Item Name</label>
                                    <input class="form-control" id="item_name" required />
                                </div>
                                
                                <div class="form-group">
                                    <label for="ItemImage">Item Description</label>
                                    <input class="form-control" id="item_description" required />
                                </div>
                                
                                <div class="form-group">
                                    <label for="ItemImage">Item Quantity</label>
                                    <input class="form-control" id="item_quantity" required />
                                </div>
                                
                                <div class="form-group">
                                    <label for="ItemImage">Item Price</label>
                                    <input class="form-control" id="item_price" required />
                                </div>
                                
                                <button id="saveBtn" class="form-control bg-dark text-warning" onclick="SaveItem()">Save Item</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
