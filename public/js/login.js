/*jshint esversion: 6 */

$(document).ready(() => {

    $('#btnLog').click(() => {

        $('#btnLog').addClass('running')
                          .children('.subMes')
                          .text('Please Wait').end(); 

        httpAjax('post', '/User/login', {
            data : {
                username : $("#username").val(),
                password : $("#passwordLogin").val()
            }
        }).then( (res) => {
            if(res.success) {
                
                swal("Yes!", res.message, "success");
                
                setTimeout(() => {
                    window.location.href = "/";
                }, 2000);
            }else {
                swal("Oh! No!", res.message, "error");   
            }
            $('#btnLog').removeClass('running')
                          .children('.subMes')
                          .text('Submit')
                          .end(); 
        });
    });

});