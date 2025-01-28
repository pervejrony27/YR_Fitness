<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'yr_fitness';

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products
$sql = "SELECT title, price, img FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="News Page">
  <meta name="keywords" content="news">
  <meta name="author" content="Nikola Štefančić">
  <title>YR Fitness | News</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <link rel="stylesheet" href="./styles/general.css">
  <link rel="stylesheet" href="./styles/header.css">
  <link rel="stylesheet" href="./styles/footer.css">
  <link rel="stylesheet" href="./styles/news.css">
  <link rel="stylesheet" href="./styles/user-sign.css">
  <link rel="stylesheet" href="./styles/animations.css">

  <link rel="icon" type="image/x-icon" href="./logos/sparta-logo-red.png">
  <style>
    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 20px;
        justify-content: center;
    }

    .card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        width: 300px;
        text-align: center;
        padding: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card img {
        width: 100%;
        border-radius: 8px;
    }

    .card h3 {
        font-size: 1.2rem;
        margin: 10px 0;
    }

    .card p {
        font-size: 1rem;
        color: #555;
    }

    .card button {
        background: #e74c3c;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
    }

    .card button:hover {
        background: #c0392b;
    }
  </style>
</head>
<body>
  
  <!-- Header Navbar Section -->
  <header>
    <nav class="navbar">
      <a href="index.html"><img src="./logos/sparta-logo-red.png" alt="envizion-logo" class="navbar-logo logo-animate"></a>
      <a href="index.html"><h1>YR <span>Fitness</span></h1></a>
      <div class="navbar-toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
      <div class="navbar-menu">
        <a href="index.html" class="navbar-link">Home</a>
        <a href="news.html" class="navbar-link underline">News</a>
        <a href="services.html" class="navbar-link">Services</a>
        <a href="group-programs.html" class="navbar-link">Group Programs</a>
        <a href="membership.html" class="navbar-link">Memberships</a>
        <a href="store.php" class="navbar-link">Store</a>
        <a href="about-us.html" class="navbar-link">About Us</a>
        <a href="contact.html" class="navbar-link">Contact</a>
        <button class="login-btn">
          Login
          <div class="tooltip">
            <p class="margin">Don't Have an Account?</p>
            <p>Sign Up</p>
          </div>
        </button>
      </div>
    </nav>
  </header>
  
  <!-- Main Content -->
  <main>

  
    <section class="hero-background-container">
      <div class="card-container">
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
              <img src="product_images/<?php echo htmlspecialchars($row['img']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
              <h3><?php echo htmlspecialchars($row['title']); ?></h3>
              <p>৳<?php echo number_format($row['price'], 2); ?></p>
              <button>Add to Wishlist</button>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No products found!</p>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <!-- Footer Section -->
  <footer class="footer" style="background-color: black; color: white; padding: 40px 20px;">
    <div class="footer-wrapper" style="display: flex; justify-content: space-between; align-items: center;">
      <div class="footer-desc" style="flex: 1; min-width: 300px; text-align: center;">
        <h1 style="font-size: 24px;">
          <span style="color: white;">YR</span>
          <span style="color: rgb(255, 38, 0);">FITNESS</span>
        </h1>
        <p>Empowering your fitness journey with state-of-the-art equipment, expert coaching, and a supportive environment to achieve your health goals.</p>
        <p><i class="fa-solid fa-location-dot footer-icon"></i> Back of New Market, Khandirpar, Cumilla</p>
        <p><i class="fa-solid fa-envelope footer-icon"></i> <a href="mailto:yrfitness@gmail.com" style="color: white; text-decoration: none;">yrfitness@gmail.com</a></p>
      </div>
      <div class="footer-empty" style="flex: 1;"></div>
      <div class="footer-owner" style="flex: 1; min-width: 300px; text-align: center;">
        <h2 style="color: orange; font-size: 20px;">FOUNDERS</h2>
        <p>Pervej and Yeasin, the dynamic founders of YR Fitness, combined their shared passion for health and innovation to create a fitness hub like no other. With a focus on community and cutting-edge techniques, YR Fitness stands as a testament to their vision of empowering individuals to transform their lives through fitness.</p>
      </div>
    </div>
  </footer>
  <div class="copyright">
    <p>Designed And Developed By YR Group</p>
  </div>

  <script src="./js/mobile-menu.js"></script>
  <script src="./js/user-sign-in.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
