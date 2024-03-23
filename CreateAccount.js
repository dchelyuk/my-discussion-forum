document.getElementById('signinform').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting
    
    // Clear previous error messages
    const errorMessages = document.getElementById('errorMessages');
    errorMessages.innerHTML = '';
    
    // Validation checks
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    let valid = true;
    
    
    if(username.length < 3) {
      errorMessages.innerHTML += '<p>Username must be at least 3 characters long.</p>';
      valid = false;
    }
    
  
    if(!/\S+@\S+\.\S+/.test(email)) {
      errorMessages.innerHTML += '<p>Please enter a valid email address.</p>';
      valid = false;
    }
    
   
    if(password.length < 6) {
      errorMessages.innerHTML += '<p>Password must be at least 6 characters long.</p>';
      valid = false;
    }
    
   
    if(valid) {
      console.log('Form is valid. Proceed with submission or further processing.');
      // make ajax call
    }
  });