let currentSlide = 0;

function changeImage() {
    const slides = document.querySelectorAll('.gallery-slide');
    const totalSlides = slides.length;

    // Hide all slides
    slides.forEach(slide => {
        slide.style.opacity = 0;
    });

    // Show the current slide
    slides[currentSlide].style.opacity = 1;

    // Move to the next slide
    currentSlide = (currentSlide + 1) % totalSlides;
}

// Set the interval to change images every 3 seconds (3000ms)
setInterval(changeImage, 3000);
