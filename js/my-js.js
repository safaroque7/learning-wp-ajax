(function ($) {

    // For Facebook Review
    $('.flexslider-facebook').flexslider({
        animation: "slide",
        animationLoop: true,
        slideshow: false,
        itemWidth: 350,
        itemMargin: 15,
        minItems: 1,
        maxItems: 1,
        controlNav: false

    });

    // For Google Review
    $('.flexslider-google').flexslider({
        animation: "slide",
        animationLoop: true,
        slideshow: false,
        itemWidth: 350,
        itemMargin: 15,
        minItems: 1,
        maxItems: 1,
        controlNav: false
    });

    // data-count

$(document).ready(function(){
    $('.counter').each(function () {
        var $this = $(this),
            countTo = $this.attr('data-count');

        $({ countNum: $this.text() }).animate({
            countNum: countTo
        },

        {
            duration: 2000, // 2 seconds
            easing: 'swing',
            step: function () {
                $this.text(Math.floor(this.countNum));
            },
            complete: function () {
                $this.text(this.countNum);
            }
        });
    });
});




})(jQuery);