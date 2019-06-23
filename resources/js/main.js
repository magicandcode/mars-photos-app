// Gets search form
const searchForm = document.getElementById('search-form');
console.log('form: ', searchForm); // Checks if we got the form

// Gets search form fields
const formInputs = document.querySelectorAll(`input, select`);
console.log(formInputs);

const formSubmit = document.querySelector('form button');

//const headers = new Headers();

// Adds eventlistener
searchForm.addEventListener('submit', (e) => {
    //e.preventDefault(); // Prevents reloading of page
});