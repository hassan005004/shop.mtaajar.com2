// ltr-sidebar-menu
$(".togl-btn").click(function () {
  $(".menu").toggleClass("togl-showw");
  $(".bg-layer").toggleClass("bg-gray");
});
$(".deletebtn-button-header,li").click(function () {
  $(".menu").removeClass("togl-showw");
  $(".bg-layer").removeClass("bg-gray");
});
$(".bg-layer").click(function () {
  $(".menu").removeClass("togl-showw");
  $(".bg-layer").removeClass("bg-gray");
});
// rtl-sidebar-menu
$(".togl-btn").click(function () {
  $(".menu-2").toggleClass("togl-showw-2");
  $(".bg-layer").toggleClass("bg-gray");
});
$(".deletebtn-button-header-rtl,li").click(function () {
  $(".menu-2").removeClass("togl-showw-2");
  $(".bg-layer").removeClass("bg-gray");
});
$(".bg-layer").click(function () {
  $(".menu-2").removeClass("togl-showw-2");
  $(".bg-layer").removeClass("bg-gray");
});
$(".our-sponsors").owlCarousel({
  rtl: layout == 2 ? true : false,
  loop: true,
  margin: 150,
  nav: true,
  autoplay: true,
  autoplayTimeout: 3000,
  responsive: {
    0: {
      items: 1,
      dots: true,
      nav: false
    },
    600: {
      items: 3,
      dots: false,
      nav: false
    },
    1000: {
      items: 4,
      dots: false,
      nav: false
    }
  }
});


let valueDisplay = document.querySelectorAll(".num");
let interval = 4000;

valueDisplay.forEach(valueDisplay => {
  let startValue = 0;
  let endValue = parseInt(valueDisplay.getAttribute("data-val"));
  let duration = Math.floor(interval / endValue);
  let counter = setInterval(function () {
    startValue += 1;
    valueDisplay.textContent = startValue;
    if (startValue == endValue) {
      clearInterval(counter);
    }
  }, duration);
});
$(".blogs-slaider").owlCarousel({
  rtl: layout == 2 ? true : false,
  loop: true,
  nav: false,
  dots: false,
  responsive: {
    0: {
      items: 1,
      margin: 8
    },
    600: {
      items: 2,
      margin: 8

    },
    992: {
      items: 3,
      margin: 8

    },
    1140: {
      items: 4,
      margin: 12
    }
  }
});
$(".client-slai").owlCarousel({
  loop: true,
  rtl: layout == 2 ? true : false,
  margin: 10,
  nav: true,
  navText: layout == "2" ? ["<i class='fa-solid fa-arrow-right fs-6'></i>", "<i class='fa-solid fa-arrow-left fs-6'></i>"] : ["<i class='fa-solid fa-arrow-left fs-6'></i>", "<i class='fa-solid fa-arrow-right fs-6'></i>"],
  dots: false,
  autoHeight: true,
  autoplay: true,
  autoplayTimeout: 3000,
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
$(".works").owlCarousel({
  rtl: layout == 2 ? true : false,
  loop: true,
  margin: 10,
  autoplay: true,
  autoplayTimeout: 2000,
  nav: false,
  dots: false,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 3
    },
    1000: {
      items: 5
    }
  }
});
$(".hotels-slaider").owlCarousel({
  rtl: layout == 2 ? true : false,
  loop: true,
  margin: 10,
  nav: false,
  dots: false,
  autoplay: true,
  autoplayTimeout: 3000,
  autoplayHoverPause: true,
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
$(".card-section").owlCarousel({
  rtl: layout == 2 ? true : false,
  loop: true,
  margin: 30,
  autoplay: true,
  autoplayTimeout: 2000,
  nav: false,
  dots: false,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 3
    },
    1000: {
      items: 4
    }
  }
});

// aos js important
AOS.init();

// You can also pass an optional settings object
// below listed default settings
AOS.init({
  // Global settings:
  disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
  startEvent: "DOMContentLoaded", // name of the event dispatched on the document, that AOS should initialize on
  initClassName: "aos-init", // class applied after initialization
  animatedClassName: "aos-animate", // class applied on animation
  useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
  disableMutationObserver: false, // disables automatic mutations' detections (advanced)
  debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
  throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)

  // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
  offset: 120, // offset (in px) from the original trigger point
  delay: 0, // values from 0 to 3000, with step 50ms
  duration: 400, // values from 0 to 3000, with step 50ms
  easing: "ease", // default easing for AOS animations
  once: false, // whether animation should happen only once - while scrolling down
  mirror: false, // whether elements should animate out while scrolling past them
  anchorPlacement: "top-bottom" // defines which position of the element regarding to window should trigger the animation
});

$('.nav-link').on('click', function () {
  //Remove any previous active classes
  $('.nav-link').removeClass('active');

  //Add active class to the clicked item
  $(this).addClass('active');
});

// Need Help button
const button = document.getElementById('quick-btn');
button.addEventListener('click', function() {
    this.classList.toggle('expanded');
});