/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var errors = [];

$(document).ready(function () {

    sessionStorage.setItem("cart", JSON.stringify([]));

    $("#triggerSub").click(function (e) {
        $("#triggerSub").addClass('running')
            .children('.subMes')
            .text('Please Wait').end();
    });

    $("#frmChange").submit(function (e) {
        e.preventDefault();
        httpAjax("post", "/User/ChangePassword", {
            data: {
                oldPass: $("#op").val(),
                newPass: $("#np").val(),
                confirmPass: $("#cp").val(),
            }
        }).then(function (res) {

            if (res.success) {
                swal("Success!", "Successfully changed the password", "success");

                setTimeout(() => {
                    window.location.href = "/User/profile";
                }, 2000);
            } else {
                swal("Opps!", res.message, "error");
            }
        })
    });

    $('#frmIM').submit(function (e) {
        e.preventDefault();
    });

    $('#frmCMS').submit(function (e) {
        e.preventDefault();

        httpAjax('post', '/nqzvacnaryuneevwnaf/cms', {
            data: {
                post_title: $("#post_title").val(),
                post_content: $("#post_description").val()
            }
        }).then((res) => {
            if (res.success) {
                swal("Success!", "Successfully Saved", "success");
            } else {
                swal("Opps!", "Something went wrong", "error");
            }
        });
    });

    $('#questAcce').submit(function (e) {
        e.preventDefault();

        console.log('a');

        $('#btnSubmitAcce').addClass('running')
            .children('.subMes')
            .text('Please Wait').end();

        var qr = $("#selectQR option:selected").text();
        swal({
            title: "Halt!",
            text: "Are you sure you want to exchange this Quest Ring? \n\n" + qr + "\n\n Remember : Once exchanged you could not undo the transaction.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((response) => {
                if (response) {


                    httpAjax('post', '/User/quests/acce', {
                        data: {
                            char_id: $("#characterSelect").val(),
                            boss_id: $("#selectBossAccessories").val(),
                            acce_id: $("#selectQR").val(),
                        }
                    }).then((res) => {
                        if (res.success) {

                            var result = JSON.parse(res.message);
                            var boolInc = true;
                            var errors = "";

                            for (let r of result) {
                                if (r.code <= 3) {
                                    errors += r.message + "\n";
                                    boolInc = false
                                }
                            }

                            if (!boolInc) {
                                swal("Oh! No!", errors, "error");
                            } else {

                                swal("Success", "Successfully exchanged! You could now logged in and check your Item Mall Inventory", "success");
                                setTimeout(() => {
                                    window.location.href = "/User/profile";
                                }, 2000);

                            }

                        } else {
                            swal("Oh! No!", res.message, "error");
                        }


                    });

                } else {
                    swal("Take your time", "", "info");
                }

                $('#btnSubmitAcce').removeClass('running')
                .children('.subMes')
                .html('<i class="fa fa-diamond">&nbsp;</i> Get your Quest Accessories</span>')
                .end();
            });



    });

    $('#btnGenerate').click(e => {

        $('#btnGenerate').addClass('running')
            .children('.subMes')
            .text('Generating Please Wait').end();
        generateRFL();

    });

});

function SaveItem() {

    httpAjax('post', '/nqzvacnaryuneevwnaf/vgrzznantr', {
        data: {
            item_category: $("#item_category").val(),
            item_packaging: $("#item_packaging").val(),
            item_image: $("#item_image").val(),
            item_id: $("#item_id").val(),
            item_name: $("#item_name").val(),
            item_description: $("#item_description").val(),
            item_quantity: $("#item_quantity").val(),
            item_price: $("#item_price").val(),
        }
    }).then((res) => {
        if (res.success) {
            swal("Success!", "Successfully Saved", "success");
            setTimeout(function () {
                window.location.href = '/';
            }, 2000);
        } else {
            swal("Opps!", "Something went wrong", "error");
        }
    });

}

function UpdateItem() {

    httpAjax('post', '/nqzvacnaryuneevwnaf/vgrzznantr/update', {
        data: {
            item_category: $("#item_category").val(),
            item_packaging: $("#item_packaging").val(),
            item_image: $("#item_image").val(),
            item_id: $("#item_id").val(),
            item_name: $("#item_name").val(),
            item_description: $("#item_description").val(),
            item_quantity: $("#item_quantity").val(),
            item_price: $("#item_price").val(),
        }
    }).then((res) => {
        if (res.success) {
            swal("Success!", "Successfully Updated", "success");
            setTimeout(function () {
                window.location.href = '/';
            }, 2000);

        } else {
            swal("Opps!", "Something went wrong", "error");
        }
    });

}

function buyChar(btn) {
    swal({
        title: "Halt!",
        text: "Are you sure you want to purchase this Character? \n\n" + $(btn).attr("item-name"),
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((response) => {
            if (response) {

                httpAjax('post', '/ExchangeMall/buyChar', {
                    data: {
                        CH0: $(btn).attr("chc0x02"),
                    }
                }).then((response) => {

                    if (response.success) {
                        swal("Success! " + response.message, {
                            icon: "success"
                        });

                        setTimeout(() => {
                            window.location.href = '/User/profile';
                        }, 2000);
                    } else {
                        swal("Opps! " + response.message, {
                            icon: "error"
                        });
                    }

                });

            } else {
                swal("Take your time", "", "info");
            }
        });
}

function removeFromEX(char) {
    httpAjax('post', '/User/removeFromExm', {
        data: {
            char_id: $(char).attr("chc0x02")
        }
    }).then((res) => {
        if (res.success) {
            swal("Success!", "Successfully Remove from Exchange Market", "success");
            setTimeout(function () {
                window.location.href = '/User/profile'
            }, 2000);
        }
    })
}

function unsealChar(char) {
    httpAjax('post', '/User/unsealed', {
        data: {
            char_id: $(char).attr("chc0x02")
        }
    }).then((res) => {
        if (res.success) {
            swal("Success!", "Successfully Unsealed", "success");
            setTimeout(function () {
                window.location.href = '/User/profile'
            }, 2000);
        }
    })
}

function removeMS(char) {
    swal({
        title: "Halt!",
        text: "Removing murderer status will cost 50 RPs, Are you sure with this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((res) => {
        if (res) {

            httpAjax('post', '/User/rmms', {
                data: {
                    char_id: $(char).attr("chc0x02")
                }
            }).then((res) => {
                if (res.success) {
                    swal("Success!", res.message, "success");
                    setTimeout(function () {
                        window.location.href = '/User/profile'
                    }, 2000);
                } else {
                    swal("Opps! " + res.message, {
                        icon: "error"
                    });
                }
            });

        } else {
            swal("Take your time", "", "info");
        }
    });

}

function RKI(char) {
    swal({
        title: "Halt!",
        text: "Ranger's Killing Intent allows you to get the 0 Possible Kills with Murderer Remission Guild Buffs that will cost 75 RPs, Are you sure with this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((res) => {
        if (res) {

            httpAjax('post', '/User/rki', {
                data: {
                    char_id: $(char).attr("chc0x02")
                }
            }).then((res) => {
                if (res.success) {
                    swal("Success!", res.message, "success");
                    setTimeout(function () {
                        window.location.href = '/User/profile'
                    }, 2000);
                } else {
                    swal("Opps! " + res.message, {
                        icon: "error"
                    });
                }
            });

        } else {
            swal("Take your time", "", "info");
        }
    });

}

function fix5101(char) {
    httpAjax('post', '/User/fix5101', {
        data: {
            char_id: $(char).attr("chc0x02")
        }
    }).then((res) => {
        if (res.success) {
            swal("Success!", "Successfully Disconnected", "success");
        }
    })
}

function PurchaseClick(item) {
    var btn = $(item);

    //TODO: Edit 250 Quantity
    if (btn.attr("item-q") != 250) {
        swal("How many do you want to buy? (Default is : 1):", {
            content: "input",
        })
            .then((value) => {
                if (value == "" || value == null) {
                    value = 1;
                }

                if (isNaN(value)) {
                    swal("Opps!", "Please enter a valid number", "error");
                } else {

                    swal({
                        title: "Halt!",
                        text: "Are you sure you want to purchase this item? \n\n" + btn.attr("item-name") + " [ x" + value + "] ",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((response) => {
                            if (response) {

                                httpAjax('post', '/ItemMall/buyItem', {
                                    data: {
                                        item_id: btn.attr("item-id"),
                                        quantity: value
                                    }
                                }).then((response) => {

                                    if (response.success) {
                                        swal("Success! " + response.message, {
                                            icon: "success"
                                        });
                                    } else {
                                        swal("Opps! " + response.message, {
                                            icon: "error"
                                        });
                                    }

                                });

                            } else {
                                swal("Take your time", "", "info");
                            }
                        });
                }

            });
    } else {

        swal({
            title: "Halt!",
            text: "Are you sure you want to purchase this item? \n\n" + btn.attr("item-name"),
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((response) => {
                if (response) {

                    httpAjax('post', '/ItemMall/buyItem', {
                        data: {
                            item_id: btn.attr("item-id"),
                            quantity: 1
                        }
                    }).then((response) => {

                        if (response.success) {
                            swal("Success! " + response.message, {
                                icon: "success"
                            });
                        } else {
                            swal("Opps! " + response.message, {
                                icon: "error"
                            });
                        }

                    });

                } else {
                    swal("Take your time", "", "info");
                }
            });
    }


}

function addToCart_Trigger(id) {
    //
    var cart = [];
    cart.push(id);

    var JSONCart = JSON.parse(sessionStorage.getItem("cart"));

    if (JSONCart == null) {
        JSONCart = [];
    }

    JSONCart.push(id);
    sessionStorage.setItem("cart", JSON.stringify(JSONCart));

    swal("Success", "Successfully Added to Cart", "success");
}

function removeToCart(id) {

    var JSONCart = JSON.parse(sessionStorage.getItem("cart"));

    var i = JSONCart.indexOf(id);

    delete JSONCart[i];

    sessionStorage.setItem("cart", JSON.stringify(JSONCart));

    swal("Success", "Successfully Removed to Cart", "success");

    setTimeout(() => {
        window.location.href = "/MidtermProject";
    }, 2000);

}

function viewCart() {
    var ids = JSON.stringify(sessionStorage.getItem("cart"));
    var idx = ids.replace("[", "");
    var final = idx.replace("]", "");
    httpAjaxPOST('/MidtermProject/viewCart', { id: final }).then((res) => {
        for (var item in res.items) {
            $("#item-listings").append("<li class='list-group-item'><div class='row'><div class='col-4'><img src='images/ro/" + res.items[item].item_file + "'/> </div><div class='col-8'><h5 class='theme-text-color'>" + res.items[item].item_name + "</h5><br/><button class='btn btn-danger' onclick='removeToCart(" + res.items[item].id + ")'>Remove to Cart</button> </div></div></li> ")
        }
    });
}

function generateRFL() {
    httpAjax('post', '/User/referral/generateLink', {
        data: {}
    }).then((res) => {
        if (res.success) {
            setTimeout(function () {
                $('#bodyCard').html('<form style="font-size: 36pt"><div class="form-group"><label><b>Your Invitation Code is</b></label><textarea type="text" class="form-control" readonly="true" style="height: 200px">' + JSON.parse(res.message).generated_link + '</textarea></div></form>')
            }, 2000);
        } else {
            swal("Opps!", "Something went wrong", "error");
        }
    });
}

