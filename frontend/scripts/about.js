$('.counter-stat').counterUp({
    delay: 10,
    time: 1000
});

$(document).ready(function () {
    $('.carousel-testimonial').owlCarousel({
        loop: true,
        margin: 0,

        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            768: {
                items: 3,
                nav: false
            },
            1000: {
                items: 3,
                nav: true,
            }
        }
    });
});