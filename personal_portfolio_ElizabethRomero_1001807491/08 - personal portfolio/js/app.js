/*
 * Navigation Interactions
 * Toggle the mobile icon to show and hide the main navigation
 * Toggle the dropdown button to show and hide the dropdown content
*/
document.addEventListener('DOMContentLoaded', () => {
    const mobileToggler = document.querySelector('.navbar-toggler');
    const navigation = document.querySelector(mobileToggler.getAttribute('data-target'));

    let dropdownToggle = document.querySelectorAll('.dropdown-toggle');
    
    mobileToggler.addEventListener('click', () => navigation.classList.toggle('collapse'))

    dropdownToggle.forEach((dropdown) => {
        dropdown.addEventListener('click', (toggler) => {
            let dropdownElement = dropdown.parentElement;
            dropdownElement.classList.toggle('collapse');
        })
    })
});






// Screen size snippet
const reportWindowSize = () => {
    const width = window.innerWidth;
    const height = window.innerHeight;
    document.getElementById('windowSize').innerHTML = `${width}px by ${height}px`;
}


/* 
    * Ensure that the DOM is loaded before running
    * the functions inside
*/
document.addEventListener('DOMContentLoaded', () => {
    reportWindowSize();
    window.onresize = reportWindowSize;
});