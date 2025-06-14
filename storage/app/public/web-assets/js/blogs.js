$("#featured_blog").owlCarousel({

    rtl: rtl == '2' ? true : false,

    loop: false,

    nav: true,

    dots: false,

    arrow: false,

    autoplay: true,

    margin: 15,

    responsiveClass: true,

    responsive: {

        0: {

            items: 1,

        },

        500: {

            items: 2,

        },

        1000: {

            items: 3,

        }

    }

});