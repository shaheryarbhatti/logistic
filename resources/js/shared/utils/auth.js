export function isLoggedIn() {
    return localStorage.getItem("isLoggedIn") == 'true';
}

export function logIn() {
    localStorage.setItem("isLoggedIn", true);
}

export function logOut() {
    localStorage.setItem("isLoggedIn", false);
}

export function callscript(){
  $(document).ready(function(){
    'use strict';
    /*-------------------------------------------------------------------------------
    Preloader
    -------------------------------------------------------------------------------*/
    $(window).on('load', function() {
      $('.acr-preloader').addClass('hidden');
    });

    $("aside .menu-item-has-children > a").on('click', function(e) {
      var submenu = $(this).next(".submenu");

      if($(this).parent().hasClass('active')){
        // alert("a");
        submenu.slideUp(200);
        $(this).parent().siblings().find('.submenu').slideUp(200);
        $(this).parent().removeClass('active');
      }else{
        // alert("b");
        // $(this).closest('ul').find(".menu-item-has-children").find('.submenu').slideUp(200);
        $(this).closest('ul').find(".menu-item-has-children").removeClass('active');
        $(this).parent().addClass('active');
        submenu.slideDown(200);
      }

    });

  });
}
