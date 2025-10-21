<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // For now, just display the message
    echo "<h2>Thank you, $name!</h2>";
    echo "<p>We’ve received your message:</p>";
    echo "<blockquote>$message</blockquote>";
    echo "<p>We’ll contact you at <strong>$email</strong> soon.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact NestCare</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="navbar">
    <h1 class="logo">NestCare</h1>
  </header>

  <section class="hero">
    <h2>Contact Us</h2>
    <form action="contact.php" method="POST" class="contact-form">
      <input type="text" name="name" placeholder="Your Name" required><br><br>
      <input type="email" name="email" placeholder="Your Email" required><br><br>
      <textarea name="message" rows="5" placeholder="Your Message" required></textarea><br><br>
      <button type="submit" class="btn">Send Message</button>
    </form>
  </section>

  <footer>
    <p>&copy; 2025 NestCare Agency. All rights reserved.</p>
  </footer>
</body>
</html>
