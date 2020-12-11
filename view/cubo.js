window.addEventListener('scroll', () => {
    document.body.style.setProperty('--scroll',window.pageYOffset / (document.body.offsetHeight - window.innerHeight));
  }, false);
  $(document).ready(function() {
    $(".menu-icon").on("click", function() {
          $("nav ul").toggleClass("showing");
    });
});

// Scrolling Effect

$(window).on("scroll", function() {
    if($(window).scrollTop()) {
          $('nav').addClass('black');
    }

    else {
          $('nav').removeClass('black');
    }
})