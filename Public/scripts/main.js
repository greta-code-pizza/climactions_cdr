// ------------------ menu burger ------------------ 
let burger = document.querySelector('#bandeau #navigation-bandeau #burger');
let menu = document.querySelector('#bandeau #navigation-bandeau #menu');

burger.addEventListener('click', function(){
    menu.classList.toggle('hidden');
})

// ------------------- slider ------------------ 
const items = document.querySelectorAll('.evenement');
const nbSlide = items.length;
const suivant = document.querySelector('.right');
const precedent = document.querySelector('.left');
let count = 0;

function slideSuivante(){
    items[count].classList.remove('active');
    
    if(count < nbSlide - 1){
        count++;
    } else{
        count = 0;
    }

    items[count].classList.add('active');
    console.log(count);
}

suivant.addEventListener('click', slideSuivante);


function slidePrecedente(){
    items[count].classList.remove('active');
    
    if(count > 0){
        count--;
    } else{
        count = nbSlide - 1
    }
    
    items[count].classList.add('active');
}

precedent.addEventListener('click', slidePrecedente);


// ------------------- fitres ------------------ 
// external js: isotope.pkgd.js

// init Isotope
var iso = new Isotope( '.grid', {
    itemSelector: '.element-item',
    layoutMode: 'fitRows'
  });
  
  // filter functions
  var filterFns = {
    // show if number is greater than 50
    numberGreaterThan50: function( itemElem ) {
      var number = itemElem.querySelector('.number').textContent;
      return parseInt( number, 10 ) > 50;
    },
    // show if name ends with -ium
    ium: function( itemElem ) {
      var name = itemElem.querySelector('.name').textContent;
      return name.match( /ium$/ );
    }
  };
  
  // bind filter button click
  var filtersElem = document.querySelector('.filters-button-group');
  filtersElem.addEventListener( 'click', function( event ) {
    // only work with buttons
    if ( !matchesSelector( event.target, 'button' ) ) {
      return;
    }
    var filterValue = event.target.getAttribute('data-filter');
    // use matching filter function
    filterValue = filterFns[ filterValue ] || filterValue;
    iso.arrange({ filter: filterValue });
  });
  
  // change is-checked class on buttons
  var buttonGroups = document.querySelectorAll('.button-group');
  for ( var i=0, len = buttonGroups.length; i < len; i++ ) {
    var buttonGroup = buttonGroups[i];
    radioButtonGroup( buttonGroup );
  }
  
  function radioButtonGroup( buttonGroup ) {
    buttonGroup.addEventListener( 'click', function( event ) {
      // only work with buttons
      if ( !matchesSelector( event.target, 'button' ) ) {
        return;
      }
      buttonGroup.querySelector('.is-checked').classList.remove('is-checked');
      event.target.classList.add('is-checked');
    });
  }
  