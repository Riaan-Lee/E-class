<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Online Learning Center</title>
  <link rel="stylesheet" href="contact.css">
</head>
<body>
  <header>
    <nav>
      <a href="home.php" class="logo">Learning Center</a>
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="help.php">Help</a></li>
      </ul>
    </nav>
  </header>
  
  <section class="contact-container">
    <!-- Left Section: Text and Form -->
    <div class="form-container">
      <h1>Contact Us</h1>
      <p>
        This is our contact page. You can use the form below to reach out to us for any inquiries, support, or feedback. 
        We look forward to hearing from you!
      </p>
      <form id="contactForm">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        
        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" required>
        
        <label for="message">Message</label>
        <textarea id="message" name="message" required></textarea>
        
        <button type="submit">Send Message</button>
      </form>

      <div class="contact-info">
        <h2>Contact Information</h2>
        <p>Email: info@learningcenter.com</p>
        <p>Phone: +1-234-567-890</p>
        <p>Instagram: <a href="https://instagram.com/learningcenter" target="_blank">@learningcenter</a></p>
        <p>Facebook: <a href="https://facebook.com/learningcenter" target="_blank">facebook.com/learningcenter</a></p>
        <p>WhatsApp: <a href="https://wa.me/1234567890" target="_blank">+1-234-567-890</a></p>
      </div>
    </div>
    
    <!-- Right Section: Image -->
    <div class="image-container">
      <img src="contact us photo.jpg" alt="Contact Us">
    </div>
  </section>
</body>
</html>
