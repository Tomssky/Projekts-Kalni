document.addEventListener("DOMContentLoaded", function () {
    //fading slideshow
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("team");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.opacity = "0";
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }
        slides[slideIndex - 1].style.display = "block";
        fadeIn(slides[slideIndex - 1]);
        setTimeout(fadeOut, 9000, slides[slideIndex - 1]); // Fade out 9 seconds
        setTimeout(showSlides, 10000); // Change slide 10 seconds
    }

    function fadeIn(element) {
        let opacity = 0;
        let timer = setInterval(function () {
            if (opacity >= 1) {
                clearInterval(timer);
            }
            element.style.opacity = opacity;
            element.style.filter = "alpha(opacity=" + opacity * 100 + ")";
            opacity += 0.02;
        }, 20);
    }

    function fadeOut(element) {
        let opacity = 1;
        let timer = setInterval(function () {
            if (opacity <= 0) {
                clearInterval(timer);
                element.style.display = "none";
            }
            element.style.opacity = opacity;
            element.style.filter = "alpha(opacity=" + opacity * 100 + ")";
            opacity -= 0.02;
        }, 20);
    }
});