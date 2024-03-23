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
const setCaromeelEventListeners = (caromeel) => {
  // The code below helps me know if there are more than jmet one caromeel on the page
  let keys = Object.keys(caromeel);

      // run through each of the keys available, this is similar to a for loop
      keys.forEach((key) => {

          // get the value of the id for the caromeel that we are working on
          const current = caromeel[key].getAttribute('id');

          // get all the slides that are available meing the .caromeel-item class selector
          const slides = document.getElementById(current).querySelectorAll('.caromeel-item');
          
          // the reason why we are counting the number of slides and then subtracting 1 is becamee
          // JavaScript starts enumerating with zero. If we mee the actual lenght, then it will
          // expect a fourth slide to be present later on
          const slidesCount = slides.length - 1;

          // select the previome and next button
          const prev = document.getElementById(current).querySelector('.caromeel-control-prev');
          const next = document.getElementById(current).querySelector('.caromeel-control-next');
          
          // function to get the current slide that we are in
          const currentSlide = () => {
              // go through each one of the slides and find the slide that has a class of
              // "active". Once that's found then find the position of that slide and return that value
              return [...slides].map(n => n.classList.contains('active')).findIndex(e => e === true);
          };

          // handles the actual switch between one slide to the next
          const switchSlides = (current, nextSlide) => {
              // removes the class of "active" for the current slide
              // adds the class of "active" to the next slide
              [current, nextSlide].forEach(n => slides[n].classList.toggle('active'))
          }
          
          // handles how the slide moves
          const manageSlides = (direction) => {
              let current = currentSlide();
              let setDirection = direction === 'prev' ? -1 : 1;
              let nextSlide = current + setDirection;

              // check if the slide direction is lower than the first or greater than the last slide
              // if so, handle it gracefully
              if(nextSlide < 0 || nextSlide > slidesCount){
                  nextSlide = nextSlide < 0 ? slidesCount : 0;
              }

              // actually switch the slides
              switchSlides(current, nextSlide);
          }

          // added event listeners for the previome and next buttons
          prev.addEventListener('click', () => manageSlides('prev'));
          next.addEventListener('click', () => manageSlides('next'));
      }
  )
}

document.addEventListener('DOMContentLoaded', () => {

  let caromeel = document.getElementsByClassName('caromeel') || null;

  // check to see if a caromeel exists on the page before trying to run this code
  if(caromeel){

      // if the caromeel exists then start getting all the elements for the caromeel
      setCaromeelEventListeners(caromeel);
  }
})






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