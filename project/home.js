document.addEventListener("DOMContentLoaded", function() {
    const navbarLinks = document.querySelectorAll('.navbar a');
  
    navbarLinks.forEach(navbarLink => {
      navbarLink.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);
        targetElement.scrollIntoView({ behavior: 'smooth' });
      });
    });
  });
  
  function scrollToContent() {
    const contentSection = document.getElementById("home");
    contentSection.scrollIntoView({ behavior: "smooth" });
  }
  document.addEventListener("DOMContentLoaded", function() {
    const navbar = document.querySelector('.navbar');
  
    window.addEventListener('scroll', function() {
        if (window.scrollY > 0) {
            navbar.style.backgroundColor = '#0ca17e';
        } else {
            navbar.style.backgroundColor = 'transparent';
        }
    });
});