$(document).ready(function () {
  "use strict";
  setTimeout(function () {
    $("html").addClass("loaded");
  }, 2000);
  $(".zero-configuration").DataTable({
    dom: "Bfrtip",
    buttons: ["excelHtml5", "pdfHtml5"]
  });

  $(window).on("scroll", function () {
    "use strict";
    if ($(window).scrollTop() > 700) {
      if ($(window).width() > 768) {
        $(".view-cart-bar").removeClass("d-none");
      } else {
        $(".view-cart-bar").addClass("d-none");
      }
    } else {
      $(".view-cart-bar").addClass("d-none");
    }
  }).change();

  $('#column').on('click', function () {
    "use strict";
    $('#column-view').addClass('d-none');
    $('#column').addClass('service-active');
    $('.listing-view').removeClass('d-none');
    $('#grid').removeClass('service-active');
  })
  $('#grid').on('click', function () {
    "use strict";
    $('#column-view').removeClass('d-none');
    $('#column').removeClass('service-active');
    $('.listing-view').addClass('d-none');
    $('#grid').addClass('service-active');
  })

  $('#close-btn2').click(function () {
    $('.view-cart-bar-2').addClass('d-none');
  });

  $(".theme3-main-slaider").owlCarousel({
    loop: true,
    rtl: rtl == "2" ? true : false,
    autoplay: true,
    autoplayTimeout: 4000,
    margin: 10,
    nav: false,
    dots: false,
    responsive: {
      320: {
        items: 1
      },
      425: {
        items: 1
      },
      768: {
        items: 2,
        center: true
      },
      992: {
        items: 2,
        center: true
      },
      1024: {
        items: 2,
        center: true
      },
      1440: {
        items: 2,
        center: true
      },
      1660: {
        items: 2,
        center: true
      }
    }
  });
  $("#theme-5-home-slider").owlCarousel({
    loop: true,
    margin: 0,
    nav: false,
    dots: false,
    rtl: rtl == "2" ? true : false,
    responsive: {
      0: {
        items: 1,
        dot: false
      },
      600: {
        items: 2,
        dot: false
      },
      1000: {
        items: 2,
        dot: false
      }
    }
  });
  //========================== theme-6-start ==========================//


  $(".theme-6-main-banner").owlCarousel({
    loop: true,
    margin: 0,
    nav: false,
    dots: true,
    autoplay: true,
    autoplayTimeout: 4000,
    rtl: rtl == "2" ? true : false,
    responsive: {
      0: {
        items: 1,
        dot: false
      },
      600: {
        items: 1,
        dot: false
      },
      1000: {
        items: 1,
        dot: false
      }
    }
  });
  $(".theme-6-category-slider").owlCarousel({
    loop: false,
    margin: 10,
    nav: false,
    dots: false,
    rtl: rtl == "2" ? true : false,
    responsive: {
      0: {
        items: 2
      },
      500: {
        items: 2
      },
      768: {
        items: 3
      },
      992: {
        items: 4
      },
      1200: {
        items: 5
      }
    }
  });

  //========================== theme-7-start ==========================//
  //------------ theme-7 owl Carousel js ------------//
  // theme-7-banner-slider //
  $(".theme-7-main-banner").owlCarousel({
    rtl: rtl == "2" ? true : false,
    loop: true,
    animateOut: 'fadeOut',
    margin: 0,
    nav: true,
    dots: true,
    navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
    autoplay: true,
    autoplayTimeout: 4000,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 1
      }
    }
  });
  $(".theme-7-category-slider").owlCarousel({
    loop: false,
    nav: true,
    dots: false,
    navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
    rtl: rtl == "2" ? true : false,
    responsive: {
      0: {
        items: 2,
        margin: 10
      },
      500: {
        items: 2,
        margin: 15

      },
      768: {
        items: 2,
        margin: 20
      },
      992: {
        items: 2,
        margin: 20

      },
      1200: {
        items: 3,
        margin: 20

      }
    }
  });
});
// theme-7-offer-banner-1-section //
$(".theme-7-offer-banner-1-carousel").owlCarousel({
  loop: true,
  autoplay: true,
  autoplayTimeout: 5000,
  responsiveClass: true,
  nav: true,
  dots: false,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1,
      margin: 10

    },
    500: {
      items: 1,
      margin: 15

    },
    992: {
      items: 2,
      margin: 20

    },
    1200: {
      items: 3,
      margin: 20

    }
  }
});
// ==== theme-7-offer-banner-3-carousel
$(".theme-7-offer-banner-3-carousel").owlCarousel({
  loop: true,
  nav: true,
  dots: false,
  animateOut: 'fadeOut',
  autoplay: true,
  autoplayTimeout: 5000,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      margin: 10,
      items: 2,
    },
    500: {
      margin: 10,
      items: 2,
    },
    992: {
      margin: 20,
      items: 2,
    },
    1200: {
      margin: 20,
      items: 4,
      loop: false
    }
  }
});


//========================== theme-8-start ==========================//
//------------ theme-8 owl Carousel js ------------//
// theme-8-banner-slider //
$(".theme-8-main-banner").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: true,
  animateOut: 'fadeOut',
  margin: 0,
  nav: false,
  dots: true,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  autoplay: true,
  autoplayTimeout: 4000,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    1000: {
      items: 1
    }
  }
});
$(".theme-8-main-banner-17").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: true,
  animateOut: 'fadeOut',
  margin: 0,
  nav: false,
  dots: false,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  autoplay: true,
  autoplayTimeout: 4000,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    1000: {
      items: 1
    }
  }
});
$(".theme-8-offer-banner-1-carousel").owlCarousel({
  loop: true,
  autoplay: true,
  autoplayTimeout: 5000,
  responsiveClass: true,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2,
      margin: 10,
      nav: false

    },
    500: {
      items: 2,
      margin: 10,
      nav: false
    },
    992: {
      items: 2,
      margin: 20,
      nav: false
    },
    1200: {
      items: 3,
      margin: 20,
      nav: false
    }
  }
});

$(".theme-8-category-slider").owlCarousel({
  loop: false,
  nav: true,
  dots: false,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2,
      margin: 10

    },
    500: {
      items: 3,
      margin: 10
    },
    768: {
      items: 3,
      margin: 15
    },
    992: {
      items: 4,
      margin: 15
    },
    1200: {
      items: 5,
      margin: 15

    }
  }
});

$(".theme-8-offer-banner-3-carousel"
).owlCarousel({
  loop: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  animateOut: 'fadeOut',
  autoplay: true,
  autoplayTimeout: 5000,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2,
      margin: 10,
      nav: false
    },
    500: {
      items: 2,
      margin: 10,
      nav: true
    },
    992: {
      items: 2,
      margin: 20,
      nav: true
    },
    1200: {
      items: 4,
      margin: 20,
      nav: true
    }
  }
});

//========================== theme-9-start ==========================//
//------------ theme-9 owl Carousel js ------------//

// ========= category ==========
$(".theme-9-category-slider").owlCarousel({
  loop: false,
  nav: true,
  dots: false,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1,
      margin: 10
    },
    500: {
      items: 2,
      margin: 15

    },
    768: {
      items: 2,
      margin: 20
    },
    992: {
      items: 2,
      margin: 20

    },
    1200: {
      items: 3,
      margin: 20

    }
  }
});

$(".theme-9-offer-banner-1-carousel,.theme-10-offer-banner-1-carousel").owlCarousel({
  loop: true,
  autoplay: true,
  autoplayTimeout: 5000,
  responsiveClass: true,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2,
      margin: 10,
      nav: false

    },
    500: {
      items: 2,
      margin: 10,
      nav: false
    },
    992: {
      items: 2,
      margin: 20,
      nav: false
    },
    1200: {
      items: 3,
      margin: 20,
      nav: false
    }
  }
});

// ==== theme-9-offer-banner-3-carousel ===
$(".theme-9-offer-banner-3-carousel").owlCarousel({
  loop: true,
  nav: false,
  dots: false,
  animateOut: 'fadeOut',
  autoplay: true,
  autoplayTimeout: 5000,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      margin: 10,
      items: 2,
    },
    500: {
      margin: 10,
      items: 2,
    },
    992: {
      margin: 20,
      items: 2,
    },
    1200: {
      margin: 20,
      items: 4,
      loop: false
    }
  }
});

//========================== theme-10-start ==========================//

// ====== theme-10 -home-slider ===
$("#theme-10-home-slider").owlCarousel({
  loop: true,
  margin: 0,
  nav: true,
  dots: false,
  animateOut: 'fadeOut',
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1,
      dot: false
    },
    600: {
      items: 2,
      dot: false
    },
    1000: {
      items: 2,
      dot: false
    }
  }
});

$(".theme-10-category-slider").owlCarousel({
  loop: false,
  nav: true,
  dots: false,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1,
      margin: 10
    },
    500: {
      items: 2,
      margin: 15

    },
    768: {
      items: 3,
      margin: 20
    },
    992: {
      items: 4,
      margin: 20

    },
    1200: {
      items: 5,
      margin: 20

    }
  }
});

// ==== theme-9-offer-banner-3-carousel ===
$(".theme-10-offer-banner-3-carousel").owlCarousel({
  loop: true,
  nav: true,
  dots: false,
  animateOut: 'fadeOut',
  autoplay: true,
  autoplayTimeout: 5000,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      margin: 10,
      items: 2,
    },
    500: {
      margin: 10,
      items: 2,
    },
    992: {
      margin: 20,
      items: 2,
    },
    1200: {
      margin: 20,
      items: 4,
      loop: false
    }
  }
});




// Preloader
$(window).on("load", function () {
  "use strict";
  $("#status").fadeOut(), $("#preloader").delay(350).fadeOut("slow");
});
// Back to Top Button JS
$(window).on("scroll", function () {
  "use strict";
  if ($(window).scrollTop() > 300) {
    $("#back-to-top").addClass("show");
  } else {
    $("#back-to-top").removeClass("show");
  }
});
$("#back-to-top").on("click", function (e) {
  "use strict";
  e.preventDefault();
  $("html, body").animate(
    {
      scrollTop: 0
    },
    "300"
  );
});
// TO DISABLE CHARACTERS IN INPUT -- START
$(".numbers_only").on("keyup", function () {
  "use strict";
  var val = $(this).val();
  if (isNaN(val)) {
    val = val.replace(/[^0-9\.]/g, "");
    if (val.split(".").length > 2) {
      val = val.replace(/\.+$/, "");
    }
  }
  $(this).val(val);
});
// TO DISABLE CHARACTERS IN INPUT -- END
function showloader() {
  "use strict";
  $("#preloader").show();
  $("#status").show();
  $('html').removeClass('loaded');
}
function hideloader() {
  "use strict";
  $("#preloader").hide();
  $("#status").hide();
  $('html').addClass('loaded');
}

function addtocart(
  product_id,
  product_slug,
  product_name,
  product_image,
  product_tax,
  product_price,
  attribute,
  addcarturl,
  buynow
) {
  "use strict";
  var variation_name = $('#variants_name').val();
  var extras_id = ($('.Checkbox:checked').map(function () {
    return this.value;
  }).get().join('| '));
  var extras_name = ($('.Checkbox:checked').map(function () {
    return $(this).attr('extras_name');
  }).get().join('| '));
  var extras_price = ($('.Checkbox:checked').map(function () {
    return $(this).attr('price');
  }).get().join('| '));
  calladdtocart(
    product_id,
    product_slug,
    product_name,
    product_image,
    product_tax,
    product_price,
    variation_name,
    addcarturl,
    buynow,
    extras_id,
    extras_name,
    extras_price
  );
}
function calladdtocart(
  product_id,
  product_slug,
  product_name,
  product_image,
  product_tax,
  product_price,
  variation_name,
  addcarturl,
  buynow,
  extras_id,
  extras_name,
  extras_price
) {

  "use strict";
  if (buynow == 0) {
    $('.addtocart').prop("disabled", true);
    $('.addtocart').html(
      '<span class="loader"></span>');
    setTimeout(function () {
      $('.addtocart').html('Add To Cart');
    }, 3000);

  } else {
    $('.buynow').prop("disabled", true);
    $('.buynow').html(
      '<span class="loader text-white"></span>');
    setTimeout(function () {
      $('.buynow').html('Buy Now');
    }, 3000);

  }
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    },
    url: addcarturl,
    data: {
      product_id: product_id,
      product_slug: product_slug,
      product_name: product_name,
      product_image: product_image,
      product_tax: product_tax,
      product_price: product_price,
      variation_name: variation_name,
      buynow: buynow,
      qty: $('.item_qty_' + product_id).val(),
      extras_id: extras_id,
      extras_name: extras_name,
      extras_price: extras_price
    },
    method: "POST",
    dataType: "json",
    success: function (response) {
      if (response.status == 1) {
        if (response.buynow == 1) {
          location.href = checkouturl + "?buynow=1";
        } else {
          showtoast("success", response.message);
          location.reload();
        }
        $(".cart-count").html(response.total_cart_count);
        $('#viewproduct-over').modal('hide');
      } else {
        $('.buynow').prop("disabled", false);
        $('.addtocart').prop("disabled", false);
        $('.addtocart').html('Add To Cart');
        $('.buynow').html('Buy Now');
        showtoast("error", response.message);
        $('#viewproduct-over').modal('hide');
      }
    },
    error: function () {
      $('.buynow').prop("disabled", false);
      $('.addtocart').prop("disabled", false);
      $('.addtocart').html('Add To Cart');
      $('.buynow').html('Buy Now');
      showtoast("error", wrong);
      $('#viewproduct-over').modal('hide');
      return false;
    }
  });
}
//========================== theme-2-start ==========================//
//------------ theme-2 owl Carousel js ------------//
// theme-2-banner-slider //
$(".theme-2-main-banner").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: true,
  margin: 0,
  nav: false,
  dots: true,
  autoplay: true,
  autoplayTimeout: 4000,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    1000: {
      items: 1
    }
  }
});
// theme-2-category-slider //
$(".category-slider").owlCarousel({
  loop: false,
  margin: 10,
  nav: false,
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2
    },
    768: {
      items: 3
    },
    992: {
      items: 4
    },
    1200: {
      items: 6
    }
  }
});
// theme-2-offer-banner //
$(".offer-banner-carousel-1").owlCarousel({
  loop: false,
  margin: 10,
  responsiveClass: true,
  nav: false,
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2,
      nav: false
    },
    500: {
      items: 2,
      nav: false
    },
    992: {
      items: 2,
      nav: false
    },
    1200: {
      items: 3,
      loop: false
    }
  }
});
// theme-2-offer-banner-3 //
$(".offer-banner-3-carousel").owlCarousel({
  loop: true,
  margin: 10,
  nav: false,
  dots: false,
  animateOut: 'fadeOut',
  autoplay: true,
  autoplayTimeout: 5000,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2,
      nav: false
    },
    500: {
      items: 2,
      nav: false
    },
    992: {
      items: 2,
      nav: false
    },
    1200: {
      items: 4,
      nav: false,
      loop: false
    }
  }
});
// theme-2-blogs-carousel //
$(".blogs-carousel").owlCarousel({
  loop: false,
  margin: 10,
  nav: true,
  dots: false,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  responsiveClass: true,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1
    },
    500: {
      items: 2
    },
    992: {
      items: 3,
      margin: 20
    },
    1200: {
      items: 4,
      margin: 20
    }
  }
});
//========================== theme-3-start ==========================//
// theme-2-slider-main-banner-section
$(
  ".theme-3-main-banner,.theme-4-main-banner, .theme-5-main-banner"
).owlCarousel({
  loop: true,
  margin: 10,
  nav: false,
  dots: true,
  autoplay: true,
  autoplayTimeout: 4000,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    1000: {
      items: 1
    }
  }
});
// theme-3-offer-banner-1-section //
$(
  ".theme-3-offer-banner-1-carousel ,.theme-4-offer-banner-1-carousel,.theme-5-offer-banner-1-carousel,.theme-6-offer-banner-1-carousel,.theme-7-offer-banner-1-carousel"
).owlCarousel({
  loop: true,
  autoplay: true,
  autoplayTimeout: 5000,
  responsiveClass: true,
  nav: false,
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2,
      margin: 10

    },
    500: {
      items: 2,
      margin: 20

    },
    992: {
      items: 2,
      margin: 20

    },
    1200: {
      items: 3,
      margin: 20

    }
  }
});
// theme-3-category-slider //
$(".theme-3-category-slider").owlCarousel({
  loop: false,
  margin: 10,
  nav: false,
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2
    },
    500: {
      items: 2
    },
    768: {
      items: 3
    },
    992: {
      items: 4
    },
    1200: {
      items: 5
    }
  }
});

// theme-2,4,5,6-offer-banner-3 //
$(
  ".theme-3-offer-banner-3-carousel,.theme-4-offer-banner-3-carousel,.theme-5-offer-banner-3-carousel,.theme-6-offer-banner-3-carousel"
).owlCarousel({
  loop: true,
  nav: false,
  animateOut: 'fadeOut',
  autoplay: true,
  autoplayTimeout: 5000,
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2,
      nav: false,
      margin: 10
    },
    500: {
      items: 2,
      nav: false,
      margin: 20
    },
    992: {
      items: 2,
      nav: false,
      margin: 20
    },
    1200: {
      items: 4,
      nav: false,
      loop: false,
      margin: 20
    }
  }
});

// theme-3-blogs-carousel //
$(".theme-3-blogs-carousel").owlCarousel({
  loop: false,
  margin: 10,
  nav: false,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  responsiveClass: true,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1,
      nav: false
    },
    500: {
      items: 2,
      nav: false
    },
    992: {
      items: 2,
      nav: false
    },
    1200: {
      items: 3,
      nav: false
    }
  }
});
//========================== theme-4-start ==========================//
// theme-4-category-slider //
$(".theme-4-category-slider").owlCarousel({
  loop: false,
  nav: false,
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1
    },
    500: {
      items: 2
    },
    768: {
      items: 3
    },
    992: {
      items: 4
    },
    1200: {
      items: 5
    }
  }
});

// theme-4-best-Selling-Products-section //
$(".theme-4-Selling-product").owlCarousel({
  loop: true,
  dots: false,
  nav: false,
  rtl: false,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 3
    },
    1000: {
      items: 4
    },
    1200: {
      items: 5
    }
  }
});
// theme-4-new-product-section //
$(".theme-4-new-product-carousel").owlCarousel({
  loop: true,
  dots: false,
  nav: false,
  rtl: false,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 3
    },
    1000: {
      items: 4
    },
    1200: {
      items: 5
    }
  }
});

// theme-4-blogs-carousel //
$(".theme-4-blogs-carousel").owlCarousel({
  loop: false,

  margin: 0,

  nav: true,

  dots: false,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  responsiveClass: true,

  rtl: rtl == "2" ? true : false,

  responsive: {
    0: {
      items: 1
    },

    500: {
      items: 2
    },

    992: {
      items: 2
    },

    1200: {
      items: 4
    }
  }
});
//========================== theme-5-start ==========================//
$(".theme-5-category-slider").owlCarousel({
  loop: false,
  margin: 10,
  nav: false,
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2
    },
    500: {
      items: 3
    },
    768: {
      items: 3
    },
    992: {
      items: 4
    },
    1200: {
      items: 5
    }
  }
});

// theme-5-blogs-carousel //
$(".theme-5-blogs-carousel").owlCarousel({
  loop: false,
  nav: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  margin: 20,
  responsiveClass: true,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1
    },
    500: {
      items: 2
    },
    992: {
      items: 3
    },
    1200: {
      items: 4
    }
  }
});


//========================== theme-11-start ==========================//
// theme-11 and theme-12 slider-main-banner-section
$(".theme-11-main-banner,.theme-12-main-banner").owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  dots: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  autoplay: true,
  autoplayTimeout: 6000,
  smartSpeed: 600,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    1000: {
      items: 1
    }
  }
});

$(".theme-19-main-banner").owlCarousel({
  loop: true,
  margin: 10,
  nav: false,
  dots: false,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  autoplay: true,
  autoplayTimeout: 5000,
  smartSpeed: 600,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    1000: {
      items: 1
    }
  }
});

//========================== category-start ==========================//
$(".theme-11-category-slider").owlCarousel({
  loop: false,
  margin: 10,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  nav: true,
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2,
      nav: false

    },
    500: {
      items: 2
    },
    768: {
      items: 3
    },
    992: {
      items: 3
    },
    1200: {
      items: 4
    }
  }
});

// theme-10,11,12,13-offer-banner-1-carousel
$(".offer-banner-1-carousel").owlCarousel({
  loop: true,
  autoplay: true,
  autoplayTimeout: 5000,
  responsiveClass: true,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2,
      margin: 10,
      nav: false

    },
    500: {
      items: 2,
      margin: 10,
      nav: false
    },
    992: {
      items: 2,
      margin: 20,
      nav: false
    },
    1200: {
      items: 3,
      margin: 20,
      nav: false
    }
  }
});
// ==== theme-11,12-offer-banner-3-carousel ===
$(".offer-banner-3-carousel").owlCarousel({
  loop: true,
  nav: false,
  dots: false,
  animateOut: 'fadeOut',
  autoplay: true,
  autoplayTimeout: 5000,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      margin: 10,
      items: 2,
    },
    500: {
      margin: 10,
      items: 2,
    },
    992: {
      margin: 20,
      items: 2,
    },
    1200: {
      margin: 20,
      items: 4,
      loop: false
    }
  }
});


//========================== theme-12 start ==========================//
//========================== category-start ==========================//
$(".theme-12-category-slider").owlCarousel({
  loop: false,
  margin: 10,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  nav: true,
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2
    },
    500: {
      items: 2
    },
    768: {
      items: 3
    },
    992: {
      items: 3
    },
    1200: {
      items: 5
    }
  }
});


//========================== theme-13-start ==========================//
// theme-13 slider-main-banner-section
$(".theme-13-main-banner").owlCarousel({
  loop: true,
  margin: 0,
  nav: true,
  dots: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  center: true,
  autoplay: true,
  autoplayTimeout: 4000,
  smartSpeed: 700,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2
    },
    600: {
      items: 2
    },
    1000: {
      items: 3
    }
  }
});
//========================== category-start ==========================//
$(".theme-13-category-slider").owlCarousel({
  loop: false,
  margin: 10,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  nav: true,
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2,
      nav: false
    },
    500: {
      items: 2,
      nav: false

    },
    768: {
      items: 3
    },
    992: {
      items: 3
    },
    1200: {
      items: 4
    }
  }
});


//========================== theme-14-start ==========================//
// theme-14 slider-main-banner-section
$(".theme-14-main-banner").owlCarousel({
  loop: true,
  margin: 0,
  nav: false,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  center: true,
  autoplay: true,
  autoplayTimeout: 4000,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1,
      dots: false,

    },
    600: {
      items: 1,
      dots: false,

    },
    1000: {
      items: 1,
      dots: true,

    }
  }
});

// theme-14-offer-banner-1-carousel
$(".theme-14-offer-banner-1-carousel").owlCarousel({
  loop: true,
  autoplay: true,
  autoplayTimeout: 5000,
  responsiveClass: true,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2,
      margin: 10,
      nav: false

    },
    500: {
      items: 2,
      margin: 20,
      nav: false
    },
    992: {
      items: 2,
      margin: 20,
      nav: false
    },
    1200: {
      items: 2,
      margin: 20,
      nav: false
    }
  }
});
//========================== category-start ==========================//
$(".theme-14-category-slider").owlCarousel({
  loop: false,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  nav: false,
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2,
      nav: false,
      margin: 10

    },
    500: {
      items: 2,
      nav: false,
      margin: 10

    },
    768: {
      items: 2,
      margin: 10
    },

    992: {
      items: 3,
      margin: 15
    },
    1200: {
      items: 4,
      margin: 15
    }
  }
});

//========================== category-start ==========================//
$(".theme-15-category-slider").owlCarousel({
  loop: false,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  nav: false,
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2,
      nav: false,
      margin: 10

    },
    500: {
      items: 2,
      nav: false,
      margin: 10

    },
    768: {
      items: 3,
      margin: 10
    },

    992: {
      items: 4,
      margin: 15
    },
    1200: {
      items: 5,
      margin: 15
    }
  }
});
// theme-15-offer-banner-1-carousel
$(".theme-15-offer-banner-1-carousel").owlCarousel({
  loop: true,
  autoplay: true,
  autoplayTimeout: 5000,
  responsiveClass: true,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2,
      margin: 10,
      nav: false

    },
    500: {
      items: 2,
      margin: 10,
      nav: false
    },
    992: {
      items: 2,
      margin: 15,
      nav: false
    },
    1200: {
      items: 2,
      margin: 15,
      nav: false
    }
  }
});

// theme-15-blogs-carousel //
$(".theme-15-blogs-carousel").owlCarousel({
  loop: false,
  nav: false,
  dots: false,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  margin: 20,
  responsiveClass: true,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1
    },
    500: {
      items: 2
    },
    992: {
      items: 2
    },
    1200: {
      items: 2
    }
  }
});

$('.footer-fiechar-slider').owlCarousel({
  loop: false,
  margin: 10,
  nav: true,
  rtl: rtl == "2" ? true : false,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>",
    "<i class='fa-solid fa-arrow-left'></i>"
  ] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    768: {
      items: 2
    },
    991: {
      items: 2
    }
  }
});


function managefavorite(product_id, vendor_id, f_url) {
  "use Strict";
  if (is_logedin == 2) {
    location.href = loginurl;
  } else {
    $("#preload").show();
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      url: f_url,
      type: "post",
      dataType: "json",
      data: {
        product_id: product_id,
        vendor_id: vendor_id
      },
      success: function (response) {
        $("#preload").hide();
        if (response.status == 0) {
          toastr.error(response.message);
        } else {
          location.reload();
        }
      }
    });
  }
}
function statusupdate(nexturl) {
  "use strict";
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success mx-1",
      cancelButton: "btn btn-danger mx-1"
    },
    buttonsStyling: false
  });
  swalWithBootstrapButtons
    .fire({
      title: are_you_sure,
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: yes,
      cancelButtonText: no,
      reverseButtons: true
    })
    .then(result => {
      if (result.isConfirmed) {
        location.href = nexturl;
      } else {
        result.dismiss === Swal.DismissReason.cancel;
      }
    });
}
$(".mobile-number").on("keyup", function () {
  "use strict";
  var val = $(this).val();
  if (isNaN(val)) {
    val = val.replace(/[^0-9\.+.-]/g, "");
    if (val.split(".").length > 2) {
      val = val.replace(/\.+$/, "");
    }
  }
  $(this).val(val);
});
$("#btndecline").on("click", function () {
  if (localStorage.getItem("modalsubscribe") != "shown") {
    setTimeout(function () {
      $("#subsciptionmodal").modal("show");
    }, 1000);
    localStorage.setItem("modalsubscribe", "shown");
  }
});
$("#btnagree").on("click", function () {
  if (localStorage.getItem("modalsubscribe") != "shown") {
    setTimeout(function () {
      $("#subsciptionmodal").modal("show");
    }, 1000);
    localStorage.setItem("modalsubscribe", "shown");
  }
});

// ===================== //

// $(document).ready(function() {
//   $(".card").click(function() {
//     $imgsrc = $(this).find(".img-src").attr("src");
//     $("#imagechange").attr("src", $imgsrc).fadeIn(1000);
//   });
// });

$(".product_gallery a").click(function () {
  $(".big-view img").attr("src", $(this).attr("href"));
  return false;
});

$(".big-view").owlCarousel({
  loop: false,

  margin: 0,

  nav: false,

  dots: false,

  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 1
    },

    1000: {
      items: 1
    }
  }
});

$("#preview-img").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: true,
  margin: 10,
  nav: true,
  dots: false,
  responsive: {
    0: {
      items: 4
    },
    600: {
      items: 4
    },
    1000: {
      items: 4
    }
  }
});

// ========================== theme-16 =========================== //
$(".theme-16-category-slider").owlCarousel({
  loop: false,
  nav: false,
  margin: 10,
  dots: false,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2
    },
    410: {
      items: 2
    },
    500: {
      items: 2
    },
    768: {
      items: 3
    },
    992: {
      items: 4
    },
    1200: {
      items: 5
    }
  }
});


$("#testimonial-slider-16").owlCarousel({
  loop: true,
  nav: false,
  margin: 10,
  dots: false,
  autoplay: true,
  autoplayTimeout: 2500,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 2
    },
    1000: {
      items: 3
    }
  }
});

$("#testimonial-slider-17").owlCarousel({
  loop: true,
  nav: false,
  margin: 10,
  dots: false,
  autoplay: true,
  autoHeight: true,
  autoplayTimeout: 2500,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 2
    },
    1000: {
      items: 3
    }
  }
});


$("#theme-17-home-slider").owlCarousel({
  loop: true,
  margin: 0,
  nav: false,
  dots: false,
  autoplay: true,
  autoplayTimeout: 2500,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1,
      dot: false
    },
    600: {
      items: 2,
      dot: false
    },
    1000: {
      items: 1,
      dot: false
    }
  }
});

$(".theme-17-category-slider").owlCarousel({
  loop: true,
  margin: 10,
  nav: false,
  dots: false,
  autoplay: true,
  autoplayTimeout: 4000,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2
    },
    400: {
      items: 2
    },
    768: {
      items: 3
    },
    992: {
      items: 4
    },
    1200: {
      items: 5
    }
  }
});

$(".theme-18-main-banner").owlCarousel({
  loop: true,
  margin: 10,
  nav: false,
  dots: false,
  autoplay: true,
  autoplayTimeout: 4000,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    1000: {
      items: 1
    }
  }
});

$(".theme-16-main-banner").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: true,
  animateOut: 'fadeOut',
  margin: 0,
  nav: false,
  dots: false,
  navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  autoplay: true,
  autoplayTimeout: 4000,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    1000: {
      items: 1
    }
  }
});

$(".theme-18-category-slider").owlCarousel({
  loop: true,
  nav: false,
  dots: false,
  margin: 10,
  autoplay: true,
  autoplayTimeout: 3000,
  autoplaySpeed: 4000,
  autoHeight: true,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2
    },
    400: {
      items: 2
    },
    500: {
      items: 2
    },
    768: {
      items: 3
    },
    992: {
      items: 4
    },
    1200: {
      items: 5
    }
  }
});

$(".theme-18-blogs-carousel").owlCarousel({
  loop: true,
  nav: false,
  dots: false,
  margin: 10,
  autoplay: true,
  autoplayTimeout: 3000,
  autoplaySpeed: 4000,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  responsiveClass: true,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 2
    },
    1000: {
      items: 3
    },
    1200: {
      items: 4
    }
  }
});

$(".theme-19-category-slider").owlCarousel({
  loop: true,
  nav: false,
  dots: false,
  margin: 10,
  autoplay: true,
  autoplayTimeout: 3000,
  autoplaySpeed: 4000,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2
    },
    400: {
      items: 2
    },
    500: {
      items: 2
    },
    768: {
      items: 3
    },
    992: {
      items: 4
    },
    1200: {
      items: 5
    }
  }
});

$(".theme-19-product-slider").owlCarousel({
  loop: true,
  nav: false,
  dots: false,
  margin: 10,
  autoplay: true,
  autoplayTimeout: 3000,
  autoplaySpeed: 2000,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1
    },
    400: {
      items: 2
    },
    500: {
      items: 2
    },
    768: {
      items: 3
    },
    992: {
      items: 4
    },
    1200: {
      items: 5
    }
  }
});

$(".theme-19-product-slider2").owlCarousel({
  loop: true,
  nav: false,
  dots: false,
  margin: 10,
  autoplay: true,
  autoplayTimeout: 3000,
  autoplaySpeed: 2000,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 1
    },
    400: {
      items: 1
    },
    500: {
      items: 1
    },
    768: {
      items: 2
    },
    992: {
      items: 2
    },
    1200: {
      items: 3
    }
  }
});

$(".top-deals20").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: false,
  nav: false,
  autoplay: true,
  margin: 10,
  autoplayTimeout: 3000,
  autoplaySpeed: 2000,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  responsive: {
    0: {
      items: 1,
    },

    380: {
      items: 2,
    },

    600: {
      items: 3,
    },

    1000: {
      items: 4,
    },

    1400: {
      items: 5,
    }
  }
});

$(".top-deals20-2").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: false,
  nav: false,
  autoplay: true,
  margin: 10,
  autoplayTimeout: 3000,
  autoplaySpeed: 2000,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  responsive: {
    0: {
      items: 1
    },
    400: {
      items: 1
    },
    500: {
      items: 1
    },
    768: {
      items: 2
    },
    992: {
      items: 2
    },
    1200: {
      items: 3
    }
  }
});


$(".theme-20-category-slider").owlCarousel({
  loop: true,
  margin: 12,
  nav: false,
  dots: false,
  autoplay: true,
  autoplaySpeed: 2000,
  autoplayTimeout: 2000,
  rtl: rtl == "2" ? true : false,
  responsive: {
    0: {
      items: 2
    },
    400: {
      items: 2
    },
    768: {
      items: 3
    },
    992: {
      items: 4
    },
    1200: {
      items: 5
    },
    1400: {
      items: 6
    }
  }
});

$(".mobile-menu-active li").click(function () {
  $(".mobile-menu-active li a").removeClass("active").eq($(this).index()).addClass("active");
});

// ============================================== //

// // Need Help button
// const button = document.getElementById('quick-btn');
// button.addEventListener('click', function () {
//   this.classList.toggle('expanded');
// });

$(document).ready(function () {
  // Function to add blur class to wrapper when modal has 'show' class
  function addBlurOnModalShow() {
    if ($('.modal').hasClass('show')) {
      $('#main-content').addClass('blurred');
    }
  }
  // Call the function on document ready
  addBlurOnModalShow();
  // Event listener for modal visibility changes
  $('.modal').on('shown.bs.modal', function () {
    $('#main-content').addClass('blurred');
  });
  $('.modal').on('hidden.bs.modal', function () {
    $('#main-content').removeClass('blurred');
  });
});


