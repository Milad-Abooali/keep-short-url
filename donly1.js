$(document).ready(function() {
    
    $("#ifbox").hide();
    $('#furl').keypress(function(e){
        if(e.which == 13){
            $('#submiturl').click();
        }
    });
   
    $("#submiturl").click(function(e)
       {
        var furl=$("#furl").val();
        var url = 'ajax.php?a=GenShortLink';
        var dataString = 'url='+furl;
        $.ajax({
            type: "POST",
            url: url,
            data: dataString,
            cache: false,
            global: false,
            async: true,
            success: function(data)
            {                              
                if (data==0) {
                    var bartext = '<i class=\"fa fa-warning fa-fw\"></i> آدرس وارد شده تکراری می باشد.';
                    $("#ifbox").removeClass("alert-danger");
                    $("#ifbox").removeClass("alert-success");
                    $("#ifbox").removeClass("alert-warning");
                    $("#ifbox").addClass("alert alert-danger");
                    $("#ifbox").html(bartext);
                    $("#ifbox").fadeIn("fast");
                    $("#ifbox").delay(3000).fadeOut(1100);
                } else {
                    var bartext = '<i class=\"fa fa-info-circle fa-fw\"></i> لینک کوتاه ایجاد شد.';
                    $("#ifbox").removeClass("alert-danger");
                    $("#ifbox").removeClass("alert-success");
                    $("#ifbox").removeClass("alert-warning");
                    $("#ifbox").addClass("alert alert-success");
                    $("#ifbox").html(bartext);
                    $(".Bnurl").html(data+'<br /><a href="'+data+'" target="_blank">Open</a>');
                    $("#ifbox").fadeIn("fast");
                    $("#ifbox").delay(3000).fadeOut(1100);
                    $("#femail").val('');
                }
            }
        });
    });

});
