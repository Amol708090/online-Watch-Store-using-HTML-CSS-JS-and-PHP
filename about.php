<?php
include 'config.php';
session_start();

$user_id=$_SESSION['user_id'];

if(!isset($user_id)){
  header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Page</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="home.css">

</head>
<body>
  
<?php
include 'user_header.php';
?>
<section class="about_cont">
    <img src="about1.jpg" alt="">
    <div class="about_descript">
      <h2>Why Choose Us ?</h2>
      <p>Welcome to AP Watch Store, your ultimate destination for premium timepieces that blend style, precision, and craftsmanship. We take pride in offering a curated collection of watches from top brands, ensuring quality and authenticity with every purchase. Whether you’re looking for a classic, luxury, or sporty design, we have the perfect watch to complement your personality and lifestyle. At AP Watch Store, customer satisfaction is our priority, and we strive to provide an exceptional shopping experience with secure payments, fast shipping, and dedicated support. Explore our collection today and find the perfect timepiece for every occasion!    </p>
    </div>
  </section>

  <section class="questions_cont">
    <div class="questions">
    <h2>Have Any Queries?</h2>
    <p>At AP watch store, we value your satisfaction and strive to provide exceptional customer service. If you have any questions, concerns, or inquiries, our dedicated team is here to assist you every step of the way.</p>
    <button class="product_btn" onclick="window.location.href='contact.php'">Contact Us</button>
    </div>
    
  </section>

<?php
include 'footer.php';
?>
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>

<script src="script.js"></script>

</body>
</html>