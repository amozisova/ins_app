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
*** scrollbars width calculation ***
*/
function getScrollbarWidth(elm) {
  if (elm === document.body) {
    return window.innerWidth - document.documentElement.clientWidth;
  } else {
    return elm.offsetWidth - elm.clientWidth;
  }
}
