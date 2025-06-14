$("#bannersection1").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  nav: false,

  dots: false,

  arrow: false,

  margin: 25,

  responsiveClass: true,

  responsive: {
    0: {
      items: 2,
      margin: 8
    },

    400: {
      items: 2,
      margin: 8
    },

    600: {
      items: 2
    },

    800: {
      items: 2
    },

    1000: {
      items: 3
    },

    1200: {
      items: 3
    }
  }
});

$("#bannersection3").owlCarousel({
  rtl: rtl == "2" ? true : false,

  autoplay: true,

  responsiveClass: true,

  responsive: {
    0: {
      items: 2,

      nav: false,

      dots: false,

      arrow: true,

      margin: 10
    },

    400: {
      items: 2,

      nav: false,

      dots: false,

      arrow: true,

      margin: 10
    },

    600: {
      items: 2,

      nav: false,

      dots: false,

      arrow: true,

      margin: 10
    },

    800: {
      items: 2,

      nav: false,

      dots: false,

      arrow: true,

      margin: 10
    },

    1000: {
      items: 3,

      nav: false,

      dots: false,

      arrow: true,

      margin: 10
    },

    1200: {
      items: 5,

      nav: false,

      dots: false,

      arrow: true,

      margin: 25
    }
  }
});

$("#tesimonial_slider").owlCarousel({
  rtl: rtl == "2" ? true : false,

  nav: false,

  dots: false,

  arrow: false,

  autoplay: false,

  loop: false,

  margin: 15,

  responsiveClass: true,

  responsive: {
    0: {
      items: 1
    },

    800: {
      items: 2
    },

    1000: {
      items: 2
    },

    1200: {
      items: 2,

      margin: 30
    }
  }
});

$("#featured_blog").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  nav: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,

  arrow: false,

  margin: 15,

  responsiveClass: true,

  responsive: {
    0: {
      items: 1
    },

    500: {
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

$("#testimonial").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  margin: 10,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  nav: true,

  dots: false,

  responsive: {
    0: {
      items: 1,

      nav: false
    },
    600: {
      items: 1,

      nav: false
    },

    1000: {
      items: 1
    }
  }
});

$("#top-deals").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  margin: 15,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  nav: true,

  dots: false,
  responsive: {
    0: {
      items: 1
    },
    300: {
      items: 2
    },

    500: {
      items: 2
    },

    600: {
      items: 3
    },

    1000: {
      items: 4
    },

    1400: {
      items: 5
    }
  }
});

$("#top-deals-16").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: true,
  margin: 10,
  autoplay: true,
  autoplayTimeout: 4000,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  nav: false,
  dots: false,
  responsive: {
    0: {
      margin: 5,
      items: 2
    },
    410: {
      items: 2
    },

    500: {
      items: 2
    },

    600: {
      items: 3
    },

    1000: {
      items: 4
    },
  }
});

$("#top-deals2").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  margin: 15,

  nav: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],


  dots: false,
  responsive: {
    0: {
      items: 1
    },
    300: {
      items: 2
    },

    500: {
      items: 2
    },

    600: {
      items: 3
    },

    1000: {
      items: 4
    },

    1400: {
      items: 5
    }
  }
});

$("#top-deals3").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  nav: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],

  dots: false,

  responsive: {
    300: {
      items: 2,
      margin: 10
    },

    500: {
      items: 2,
      margin: 10
    },

    600: {
      items: 3,
      margin: 10
    },

    1000: {
      items: 3,
      margin: 15
    },

    1400: {
      items: 3,
      margin: 15
    }
  }
});

$("#top-deals4").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  nav: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],

  dots: false,

  responsive: {
    300: {
      items: 2,
      margin: 10
    },

    500: {
      items: 2,
      margin: 10
    },

    600: {
      items: 3,
      margin: 10
    },

    1000: {
      items: 4,
      margin: 15
    },

    1400: {
      items: 4,
      margin: 15
    }
  }
});

$("#top-deals12").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: false,
  nav: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  responsive: {
    300: {
      items: 2,
      margin: 10
    },

    500: {
      items: 2,
      margin: 10
    },

    600: {
      items: 3,
      margin: 10
    },

    1000: {
      items: 3,
      margin: 15
    },

    1400: {
      items: 4,
      margin: 15
    }
  }
});

$("#top-deals5").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: false,
  nav: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  responsive: {
    300: {
      items: 1,
      margin: 10
    },

    500: {
      items: 2,
      margin: 10
    },

    600: {
      items: 2,
      margin: 10
    },

    1000: {
      items: 2,
      margin: 15
    },

    1400: {
      items: 3,
      margin: 15
    }
  }
});

$("#top-deals17").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: true,
  nav: false,
  autoplay: true,
  margin: 10,
  autoplayTimeout: 3000,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  responsive: {
    0: {
      items: 2,
    },

    500: {
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

$("#top-deals20").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: true,
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

$("#top-deals15").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: true,
  nav: false,
  autoplay: true,
  margin: 10,
  autoplayTimeout: 3000,
  autoplaySpeed: 2000,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  responsive: {
    0: {
      items: 2,
    },

    380: {
      items: 2,
    },

    600: {
      items: 3,
    },

    1000: {
      items: 3,
    },

    1400: {
      items: 4,
    }
  }
});

$("#top-deals18").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: true,
  nav: false,
  autoplay: true,
  margin: 10,
  autoplaySpeed: 3000,
  autoplayTimeout: 3000,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  responsive: {
    0: {
      items: 2,
    },

    500: {
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
$("#top-deals6").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  nav: false,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  responsive: {
    0: {
      items: 1,
      margin: 10
    },
    200: {
      items: 2,
      margin: 10
    },

    500: {
      items: 2,
      margin: 10
    },

    600: {
      items: 2,
      margin: 10
    },

    1000: {
      items: 2,
      margin: 15
    },

    1400: {
      items: 4,
      margin: 15
    }
  }
});
$("#top-deals-slider").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  nav: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  responsive: {
    300: {
      items: 1,
      margin: 10
    },

    500: {
      items: 1,
      margin: 10
    },

    600: {
      items: 1,
      margin: 10
    },

    768: {
      items: 2,
      margin: 19
    },

    1000: {
      items: 2,
      margin: 15
    },

    1400: {
      items: 3,
      margin: 15
    }
  }
});

$("#top-deals8,#top-deals10").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: false,
  nav: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  responsive: {
    300: {
      items: 2,
      margin: 10
    },

    500: {
      items: 2,
      margin: 10
    },

    600: {
      items: 2,
      margin: 10
    },

    1000: {
      items: 2,
      margin: 15
    },

    1400: {
      items: 4,
      margin: 15
    }
  }
});
$("#top-deals9").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: false,
  nav: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  responsive: {
    300: {
      items: 1,
      margin: 10
    },

    500: {
      items: 2,
      margin: 10
    },

    600: {
      items: 2,
      margin: 10
    },

    1000: {
      items: 2,
      margin: 15
    },

    1400: {
      items: 3,
      margin: 15
    }
  }
});
$("#testimonial2").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  margin: 8,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],

  nav: true,

  dots: false,

  responsive: {
    0: {
      items: 1
    },

    500: {
      items: 2
    },

    600: {
      items: 2
    },

    1000: {
      items: 2
    },

    1400: {
      items: 2
    }
  }
});

$("#testimonial3").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],

  nav: true,

  dots: false,

  responsive: {
    0: {
      items: 1,
      margin: 10

    },

    500: {
      items: 2,
      margin: 10

    },

    600: {
      items: 2,
      margin: 25

    },

    1000: {
      items: 3,
      margin: 25

    },

    1400: {
      items: 3,
      margin: 25

    }
  }
});

$("#testimonial4").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],

  margin: 15,

  nav: true,

  dots: false,

  responsive: {
    0: {
      items: 1
    },

    500: {
      items: 2
    },

    600: {
      items: 2
    },

    1000: {
      items: 3
    },

    1400: {
      items: 4
    }
  }
});

$("#testimonial6").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: false,
  margin: 15,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],

  nav: true,

  dots: false,

  responsive: {
    0: {
      items: 1
    },

    500: {
      items: 2
    },

    600: {
      items: 2
    },

    1000: {
      items: 2
    },

    1400: {
      items: 4
    }
  }
});

$("#testimonial7").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  margin: 15,

  nav: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],

  dots: false,

  responsive: {
    0: {
      items: 1
    },

    500: {
      items: 1
    },

    600: {
      items: 2
    },

    1000: {
      items: 2
    },

    1400: {
      items: 3
    }
  }
});

$("#testimonial10").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  margin: 15,

  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  responsive: {
    0: {
      items: 1,
      nav: false,
      dots: true
    },

    500: {
      items: 2,
      nav: false,
      dots: true
    },

    600: {
      items: 2,
      nav: true,
      dots: false
    },

    1000: {
      items: 2,
      nav: true,
      dots: false
    },

    1400: {
      items: 3,
      nav: true,
      dots: false
    }
  }
});
$("#testimonial8").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  margin: 15,

  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  responsive: {
    0: {
      items: 1,
      nav: false,
      dots: true
    },

    500: {
      items: 2,
      nav: false,
      dots: true
    },

    600: {
      items: 2,
      nav: true,
      dots: false
    },

    1000: {
      items: 2,
      nav: true,
      dots: false
    },

    1400: {
      items: 3,
      nav: true,
      dots: false
    }
  }
});

$("#testimonial9").owlCarousel({
  rtl: rtl == "2" ? true : false,

  loop: false,

  margin: 15,

  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  responsive: {
    0: {
      items: 1,
      nav: false,
      dots: true
    },

    500: {
      items: 1,
      nav: false,
      dots: true
    },

    600: {
      items: 2,
      nav: true,
      dots: false
    },

    1000: {
      items: 2,
      nav: true,
      dots: false
    },

    1400: {
      items: 2,
      nav: true,
      dots: false
    }
  }
});

// top deals start
$(".carousel-items-2").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: false,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  autoplay: true,
  autoplayTimeout: 4000,
  responsive: {
    300: {
      items: 1,
      margin: 10,
      nav: false,

    },

    500: {
      items: 1,
      margin: 10,
      nav: true

    },

    600: {
      items: 2,
      margin: 10,
      nav: true

    },

    1000: {
      items: 2,
      margin: 15,
      nav: true

    },

    1400: {
      items: 2,
      margin: 15,
      nav: true

    }
  }
});
$(".carousel-items-3").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: false,
  nav: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  autoplay: true,
  autoplayTimeout: 4000,
  responsive: {
    300: {
      items: 1,
      margin: 10,
      nav: false
    },

    500: {
      items: 2,
      margin: 10,
      nav: true
    },

    600: {
      items: 2,
      margin: 10,
      nav: true
    },

    1000: {
      items: 3,
      margin: 15,
      nav: true
    },

    1400: {
      items: 3,
      margin: 15,
      nav: true
    }
  }
});
$(".carousel-items-4").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: false,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  autoplay: true,
  autoplayTimeout: 4000,
  responsive: {
    300: {
      items: 1,
      margin: 10,
      nav: false

    },

    500: {
      items: 2,
      margin: 10,
      nav: true

    },

    600: {
      items: 2,
      margin: 10,
      nav: true

    },

    1000: {
      items: 3,
      margin: 15,
      nav: true

    },

    1400: {
      items: 4,
      margin: 15,
      nav: true

    }
  }
});

// ================= theme-13 testimonial =================

$(".carousel-testimonial").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: false,
  nav: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  autoplay: true,
  autoplayTimeout: 4000,
  responsive: {
    300: {
      items: 1,
      margin: 10
    },

    500: {
      items: 1,
      margin: 10
    },

    769: {
      items: 2,
      margin: 10
    },

    1000: {
      items: 2,
      margin: 15
    },

    1400: {
      items: 2,
      margin: 15
    }
  }
});
$(".testimonial-12").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: false,
  nav: true,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  autoplay: true,
  autoplayTimeout: 4000,
  responsive: {
    300: {
      items: 1,
      margin: 10,
      nav: false
    },

    500: {
      items: 1,
      margin: 10,
      nav: true
    },

    600: {
      items: 2,
      margin: 10,
      nav: true
    },

    1000: {
      items: 3,
      margin: 15,
      nav: true
    },

    1400: {
      items: 3,
      margin: 15,
      nav: true
    }
  }
});


// ================= theme-14 testimonial =================
// ----- theme-14,15-deal-carousel
$(".theme-14-deal-carousel").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: false,
  nav: false,
  navText: rtl == "2" ? ["<i class='fa-solid fa-arrow-right'></i>", "<i class='fa-solid fa-arrow-left'></i>"] : ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
  dots: false,
  autoplay: true,
  autoplayTimeout: 4000,
  responsive: {
    300: {
      items: 2,
      margin: 5
    },

    500: {
      items: 2,
      margin: 10
    },

    600: {
      items: 2,
      margin: 10
    },

    1000: {
      items: 2,
      margin: 15
    },

    1400: {
      items: 2,
      margin: 15
    }
  }
});


$("#testimonial-slider-18").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: true,
  margin: 10,
  nav: false,
  autoplay: true,
  autoplaySpeed: 4000,
  autoplayTimeout: 4000,
  dots: false,
  responsive: {
    0: {
      items: 1
    },

    500: {
      items: 1
    },

    600: {
      items: 1
    },

    1000: {
      items: 2
    },

    1400: {
      items: 2
    }
  }
});

$("#testimonial-slider-19").owlCarousel({
  rtl: rtl == "2" ? true : false,
  loop: true,
  margin: 10,
  nav: false,
  autoplay: true,
  autoHeight:true,
  autoplaySpeed: 4000,
  autoplayTimeout: 4000,
  dots: false,
  responsive: {
    0: {
      items: 1
    },

    500: {
      items: 1
    },

    600: {
      items: 2
    },

    1000: {
      items: 3
    },

    1400: {
      items: 4
    }
  }
});