(function($) {
  'use strict';
  $(function() {
    $(".nav-settings").on("click", function() {
      $("#right-sidebar").toggleClass("open");
    });
    $(".settings-close").on("click", function() {
      $("#right-sidebar,#theme-settings").removeClass("open");
    });

    $("#settings-trigger").on("click", function(){
      $("#theme-settings").toggleClass("open");
    });

    // Background constants
    var navbar_classes = "navbar-danger navbar-success navbar-warning navbar-dark navbar-light navbar-primary navbar-info navbar-pink";
    var sidebar_classes = "sidebar-light sidebar-dark";
    var $body = $("body");
    var $navbar = $(".navbar");

    // Load sidebar theme from localStorage
    if (localStorage.getItem('sidebar-theme')) {
      $body.addClass(localStorage.getItem('sidebar-theme'));
    }

    // Load navbar theme from localStorage
    if (localStorage.getItem('navbar-theme')) {
      $navbar.addClass(localStorage.getItem('navbar-theme'));
    }

    // Sidebar backgrounds
    $("#sidebar-light-theme").on("click", function() {
      $body.removeClass(sidebar_classes);
      $body.addClass("sidebar-light");
      $(".sidebar-bg-options").removeClass("selected");
      $(this).addClass("selected");
      localStorage.setItem('sidebar-theme', 'sidebar-light');
    });

    $("#sidebar-dark-theme").on("click", function() {
      $body.removeClass(sidebar_classes);
      $body.addClass("sidebar-dark");
      $(".sidebar-bg-options").removeClass("selected");
      $(this).addClass("selected");
      localStorage.setItem('sidebar-theme', 'sidebar-dark');
    });

    // Navbar backgrounds
    $(".tiles").on("click", function() {
      var newClass = $(this).attr('class').split(' ')[1]; // Get the second class, e.g., 'primary', 'success'
      $navbar.removeClass(navbar_classes);
      $navbar.addClass("navbar-" + newClass);
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
      localStorage.setItem('navbar-theme', "navbar-" + newClass);
    });

    // Handle default theme
    $(".tiles.default").on("click", function() {
      $navbar.removeClass(navbar_classes);
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
      localStorage.removeItem('navbar-theme');
    });
  });
})(jQuery);
