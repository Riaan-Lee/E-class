<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Help - Online Learning Center</title>
  <link rel="stylesheet" href="help.css">
  <script src="scripts.js" defer></script>
</head>
<body>
  <header>
    <nav>
      <a href="home.php" class="logo">Learning Center</a>
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="course.php">Courses</a></li>
        <li><a href="contact.php">Contact Us</a></li>
      </ul>
    </nav>
  </header>
  
  <section class="faq-section">
    <h1>Help & Frequently Asked Questions</h1>
    <p>Welcome to the Online Learning Center's help page. Here, you'll find answers to common questions regarding account management, course registration, accessing the online library, and joining online classes. If you need further assistance, feel free to contact us through the <a href="contact.php">Contact Us</a> page.</p>

    <div class="faq">
      <h3 class="faq-title" onclick="toggleFAQ(this)">How do I register for an account?</h3>
      <p class="faq-content">To register for an account, click on the <a href="register.php">"Register"</a> button on the homepage. Fill out the required details, including your name, email, and password. After submitting the form, you will receive an email with a confirmation link. Click the link to verify your account and start using the platform.</p>
    </div>

    <div class="faq">
      <h3 class="faq-title" onclick="toggleFAQ(this)">How do I log in to my account?</h3>
      <p class="faq-content">To log in, click on the <a href="login.php">"Login"</a> button at the top of the homepage. Enter your registered email address and password, and click "Sign In." If you've forgotten your password, you can use the "Forgot Password" link to reset it.</p>
    </div>

    <div class="faq">
      <h3 class="faq-title" onclick="toggleFAQ(this)">How can I register for a course?</h3>
      <p class="faq-content">Once logged in, go to the <a href="course.php">"Courses"</a> page. Browse the available courses and click on the course you want to join. You can then click "Enroll Now." If the course requires payment, you will be redirected to the payment page to complete the enrollment process.</p>
    </div>

    <div class="faq">
      <h3 class="faq-title" onclick="toggleFAQ(this)">How do I access the library?</h3>
      <p class="faq-content">After logging in, navigate to the <a href="library.php">"Library"</a> page from the main menu. Here, you can browse books, articles, and other resources available to registered users. You can also search for specific topics or authors using the search bar.</p>
    </div>

    <div class="faq">
      <h3 class="faq-title" onclick="toggleFAQ(this)">How can I join an online class?</h3>
      <p class="faq-content">To join an online class, go to the <a href="login.php">"Join Meeting"</a> section after logging in. Find your course and click on the "Join Class" button at the scheduled time. This will redirect you to the virtual classroom where you can interact with your tutor and fellow students.</p>
    </div>

    <div class="faq">
      <h3 class="faq-title" onclick="toggleFAQ(this)">What should I do if I encounter technical issues?</h3>
      <p class="faq-content">If you encounter technical issues, please visit the <a href="contact.php">"Contact Us"</a> page and fill out the support form with a detailed description of the problem. Our support team will get back to you as soon as possible to assist.</p>
    </div>
  </section>

  <footer>
    <p>&copy; 2024 Online Learning Center. All rights reserved.</p>
  </footer>
</body>
</html>
