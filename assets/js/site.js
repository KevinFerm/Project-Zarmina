$(document).ready(function(){

    /** Handles login request **/
      $('#login').click(function() {

        $.ajax({
            type: "POST",
            url: 'user/processLogin',
            data: {
                username: $("#username").val(),
                pass: $("#pass").val()
            },
            success: function(data)
            {
                if (data === "success!") {
                    window.location.replace('/');
                }
            }
        });
    });

        /** Handles register request **/
      $('#register').click(function() {

        $.ajax({
            type: "POST",
            url: 'user/processRegister',
            data: {
                username: $("#username").val(),
                pass: $("#pass").val(),
                email: $("#email").val()
            },
            success: function(data)
            {
                if (data === 'success!') {
                    window.location.replace('/login');
                }
            }
        });

    });
  });

    // $(".toggle").slideToggle();
    //             $.ajax({
    //                type: "POST",
    //                url: "index.php/mainstep/ajaxSteps/ajax",
    //                // success: function(response){
    //                //            $("#steps").html(response);
    //                //          }
    //        });
    // $(".button").click(function(){
    //     var x = $(this).attr("id").substr(7,100);
    //     $("#toggle_"+x).slideToggle();
    //     $.get("http://42foo.com/zombiesite/index.php/ajax/slide/"+x+"/0", function (msg) {
    //         $("#swipe_"+x).html(msg);
    //     });
    //     if($(this).hasClass("show-more-height")) {
    //         $(this).html("View More");
    //     } else {
    //         $(this).html("View Less");
    //     }

    //     $(this).toggleClass("show-more-height");
    // });
    // $(".ministeps").click(function(){
    //     var x = $(this).attr("id").substr(10,100);
    //     $("#ministep_"+x).slideToggle();
    //             $.get("index.php/mainstep/getStepsText/"+x, function (msg) {
    //             $("#ministep_"+x).html(msg);
    //     });
    // });
    // $(".plannerlink").click(function(){
    //     $(".planner").slideToggle();
    // });

    // var slide = new Array();



    // $(".swipe").on("swiperight",function(){
    //     var x = $(this).attr("id").split("_");
    //     if(slide[x[1]] == null){
    //         slide[x[1]] = 1;
    //     }
    //     else
    //     {
    //          slide[x[1]]++;
    //     }
    //     $.get("http://42foo.com/zombiesite/index.php/ajax/slide/"+x[1]+"/"+slide[x[1]], function (msg) {
    //         if (msg != "")
    //         {
    //             $("#swipe_"+x[1]).html(msg);
    //         }
    //         else
    //         {
    //             slide[x[1]]--;
    //         }
    //     });
    // });

    // $(".swipe").on("swipeleft",function(){
    //     var x = $(this).attr("id").split("_");
    //     if(slide[x[1]] == null)
    //     {
    //         return;
    //     }
    //     else
    //     {
    //         if(slide[x[1]] != 0)
    //         {
    //             slide[x[1]]--;
    //         }
    //     }
    //     $.get("http://42foo.com/zombiesite/index.php/ajax/slide/"+x[1]+"/"+slide[x[1]], function (msg) {
    //         $("#swipe_"+x[1]).html(msg);
    //     });
    // });
