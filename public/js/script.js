/*
*** current link styling ***
*/ 
currentLinks = document.querySelectorAll('a[href="'+document.URL+'"]');
    
currentLinks.forEach(function(link) {
        link.className += 'current-link';
});
    

/*
*** toggle navigation menu *** 
 */
// Get toggle button and menu items div
const toggleBtn = document.getElementById('toggle-icon');
const menuItems = document.querySelector('.menu-items');

function toggleNav() {
  const responsive_class_name = 'responsive'
  menuItems.classList.toggle(responsive_class_name);
}

// When toggle button pressed, run toggleNav function
toggleBtn.addEventListener('click', toggleNav);