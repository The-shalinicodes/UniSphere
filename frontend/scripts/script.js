
function openNav() {
    document.getElementById("mySidenav").style.width = "280px";
    document.getElementById("mySidenav").style.padding = "10px";
    document.querySelector(".carousel-control-next").style.display = 'none';
    document.querySelector(".carousel-indicators").style.display = 'none';
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("mySidenav").style.padding = "0";
    document.querySelector(".carousel-control-next").style.display = 'block';
    document.querySelector(".carousel-indicators").style.display = 'flex';
}

$(document).ready(function () {
    $('.carousel-gal').slick({
        slidesToShow: 3, // default desktop values
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 3000,
        centerMode: true,
        responsive: [
            {
                breakpoint: 992, // tablet breakpoint
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768, // mobile breakpoint
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
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
