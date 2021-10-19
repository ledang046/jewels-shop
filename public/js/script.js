$(document).ready(function () {
    $('.bar').click(function (e) { 
        e.preventDefault();
        $('.menu-navbar').addClass('active');
        $('.cover').addClass('active');
    });
    $('.cover').click(function (e) { 
        e.preventDefault();
        $('.menu-navbar').removeClass('active');
        $('.cover').removeClass('active');
    });
    $("#cart").on("click", function() {
        $(".shopping-cart").fadeToggle("fast","linear");
      });
});


   
    
