// JavaScript for Registration Form Validation

document.addEventListener('DOMContentLoaded', () => {
  const registerForm = document.getElementById('registerform');
  const emailInput = document.getElementById('email');
  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('confirm-password');
  const passwordStrengthMessage = document.createElement('p');
  passwordStrengthMessage.id = 'password-strength';
  passwordInput.parentNode.insertBefore(passwordStrengthMessage, passwordInput.nextSibling);

  // Handle password input to show strength
  passwordInput.addEventListener('input', () => {
    const password = passwordInput.value.trim();
    const strength = getPasswordStrength(password);
    passwordStrengthMessage.textContent = `Password Strength: ${strength}`;
    passwordStrengthMessage.style.color = strength === 'Strong' ? 'green' : 'red';
  });

  // Handle form submission
  registerForm.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent the default form submission
    
    clearErrorMessages();

    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();
    const confirmPassword = confirmPasswordInput.value.trim();

    // Simple form validation
    if (!validateEmail(email)) {
      showError(emailInput, 'Please enter a valid email address.');
      return;
    }

    if (!validatePassword(password)) {
      showError(passwordInput, 'Password must be at least 6 characters long, contain at least one uppercase letter, one lowercase letter, and one number.');
      return;
    }

    if (password !== confirmPassword) {
      showError(confirmPasswordInput, 'Passwords do not match.');
      return;
    }

    // Simulate registration process (e.g., send request to server)
    alert('Registration successful!');
    // You can add your actual registration logic here
  });

  // Function to validate email format
  function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
  }

  // Function to validate password strength
  function validatePassword(password) {
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{6,}$/;
    return passwordPattern.test(password);
  }

  // Function to get password strength
  function getPasswordStrength(password) {
    if (password.length < 6) {
      return 'Weak';
    }
    const hasUpperCase = /[A-Z]/.test(password);
    const hasLowerCase = /[a-z]/.test(password);
    const hasNumber = /\d/.test(password);

    if (hasUpperCase && hasLowerCase && hasNumber && password.length >= 6) {
      return 'Strong';
    } else {
      return 'Weak';
    }
  }

  // Function to show error message below the input box
  function showError(inputElement, message) {
    let errorMessage = inputElement.nextElementSibling;
    if (!errorMessage || !errorMessage.classList.contains('error-message')) {
      errorMessage = document.createElement('p');
      errorMessage.classList.add('error-message');
      errorMessage.style.color = 'red';
      inputElement.parentNode.insertBefore(errorMessage, inputElement.nextSibling);
    }
    errorMessage.textContent = message;
  }

  // Function to clear all error messages
  function clearErrorMessages() {
    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach((errorMessage) => {
      errorMessage.textContent = '';
    });
  }
});
