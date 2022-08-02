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


/*
*** icons hover ***
*/

//get icon images
const icon=document.querySelectorAll('.home-card');

function replaceImg() {
  
}