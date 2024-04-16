
$(document).ready(function(){
    $("#openAddress").click(function(){
        $("#section").css("display","block");
    })
    $("#close").click(function(){
        $("#section").css("display","none");
    })
    $("#edit").click(function(){
        $("#section").css("display","block");
    })
    $("#updateAddress").click(function(){
        var fullname = $("#fullname").val();
        var email = $("#email").val();
        var phone_no = $("#phone_no").val();
        var province = $("#province").val().toLowerCase();
        var city = $("#city").val();
        var brgy = $("#brgy").val();
        var street = $("#street").val();
        $.ajax({
            url     : "ShippingAddress/editAddress.php",
            method  :"POST",
            data    : {
                fullname : fullname,
                email   : email,
                phone_no : phone_no,
                province : province,
                city    : city,
                brgy    : brgy,
                street : street
            },
            success  : function(response){
                alert(response);
            }
        })
    })

})