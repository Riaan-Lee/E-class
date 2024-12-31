// JavaScript for Login Form Validation

document.addEventListener('DOMContentLoaded', () => {
  const loginForm = document.getElementById('loginform');
  const emailInput = document.getElementById('email');
  const passwordInput = document.getElementById('password');
  const passwordStrengthMessage = document.createElement('p');
  passwordStrengthMessage.id = 'password-strength';
  passwordInput.parentNode.appendChild(passwordStrengthMessage);

  // Handle password input to show strength
  passwordInput.addEventListener('input', () => {
    const password = passwordInput.value.trim();
    const strength = getPasswordStrength(password);
    passwordStrengthMessage.textContent = `Password Strength: ${strength}`;
    passwordStrengthMessage.style.color = strength === 'Strong' ? 'green' : 'red';
  });

  // Handle form submission
  loginForm.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent the default form submission
    
    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    // Simple form validation
    if (!validateEmail(email)) {
      alert('Please enter a valid email address.');
      return;
    }

    if (!validatePassword(password)) {
      alert('Password must be at least 6 characters long, contain at least one uppercase letter, one lowercase letter, and one number.');
      return;
    }

    // Simulate login process (e.g., send request to server)
    alert('Login successful!');
    // You can add your actual login logic here
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
});
