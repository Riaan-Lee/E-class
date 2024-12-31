// JavaScript for Carousel
let currentSlide = 0;
const testimonials = document.querySelectorAll(".testimonial");

function showTestimonial(index) {
  testimonials.forEach((testimonial, i) => {
    testimonial.style.display = i === index ? "block" : "none";
  });
}

document.addEventListener("DOMContentLoaded", () => {
  showTestimonial(currentSlide);

  setInterval(() => {
    currentSlide = (currentSlide + 1) % testimonials.length;
    showTestimonial(currentSlide);
  }, 3000);
});

// Toggle FAQ
function toggleFAQ(element) {
  const content = element.nextElementSibling;
  content.style.display = content.style.display === "block" ? "none" : "block";
}
// Enroll Button Functionality
function enroll() {
    alert("Enrollment successful! Check your dashboard for course details.");
  }
  
  // Logout Functionality
  function logout() {
    alert("You have been logged out.");
  }
  
  // Navigate to Course (For Dashboard)
  function goToCourse() {
    alert("Redirecting to your course page...");
  }