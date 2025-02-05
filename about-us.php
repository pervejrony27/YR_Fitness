<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Nikola Štefančić">
  <title>YR Fitness | About Us</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://vjs.zencdn.net/8.6.1/video-js.css" rel="stylesheet" />
  
  <link rel="stylesheet" href="./styles/general.css">
  <link rel="stylesheet" href="./styles/header.css">
  <link rel="stylesheet" href="./styles/footer.css">
  <link rel="stylesheet" href="./styles/about-us.css">
  <link rel="stylesheet" href="./styles/user-sign.css">
  <link rel="stylesheet" href="./styles/animations.css">

  <link rel="icon" type="image/x-icon" href="./logos/sparta-logo-red.png">

  

</head>
<body>
  
  <!-- Header Navbar Section -->

  <header>

    <nav class="navbar">

      <a href="index.php"><img src="./logos/sparta-logo-red.png" alt="envizion-logo" class="navbar-logo logo-animate"></a>
      <a href="index.php"><h1>YR<span class="logo-animate"> Fitness</span></h1></a>

      <div class="navbar-toggle" id="mobile-menu">

        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>

      </div>

      <div class="navbar-menu">

      <a href="index.php" class="navbar-link">Home</a>
        <a href="news.php" class="navbar-link">News</a>
        <a href="services.php" class="navbar-link">Services</a>
        <a href="group-programs.php" class="navbar-link ">Group Programs</a>
        <a href="membership.php" class="navbar-link ">Memberships</a>
        <a href="store.php" class="navbar-link">Store</a>
        <a href="about-us.php" class="navbar-link underline">About Us</a>
        <a href="contact.php" class="navbar-link">Contact</a>


        <?php if ($username): ?>
                <div class="user-dropdown">
                    <button class="user-name-btn">
                        <?php echo htmlspecialchars($username); ?>
                        <div class="dropdown-content">
                            <a href="dashboard.php">Dashboard</a>
                            <a href="logout.php">Logout</a>
                        </div>
                    </button>
                </div>
            <?php else: ?>
              <button class="login-btn">
                Login
                <div class="tooltip">
                  <p class="margin">Don't Have an Account?</p>
                  <p>You can Sign Up</p>
                </div>
              </button>
            <?php endif; ?>

      </div>

    </nav>

  </header>


    <main>

      <!-- User Login || Sign In  -->

      <div class="user-sign-flex">
        <section class="user-sign-in-container">
      
          <span class="icon-close" id="closeButton">
            <ion-icon name="close-circle"></ion-icon>
          </span>
      
          <div class="form-box login">
            <h2>Login</h2>
            <!-- Update the form to use the POST method and point to login.php -->
            <form action="login.php" method="POST">
      
              <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <!-- Add a name attribute to match the PHP script -->
                <input type="email" name="email" required>
                <label for="email">Email</label>
              </div>
      
              <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <!-- Add a name attribute to match the PHP script -->
                <input type="password" name="password" required>
                <label for="password">Password</label>
              </div>
      
              <div class="remember-forget-pass">
                <label><input type="checkbox">Remember Me</label>
                <a href="#" class="forgot-pass">Forgot Password?</a>
              </div>
              <button type="submit" class="submit-btn">Login</button>
              <div class="login-register">
                <p>Don't have an Account?<a href="#" class="register-link">Register</a></p>
              </div>
            </form>
          </div>
      
          <span class="icon-close" id="closeButton">
            <ion-icon name="close"></ion-icon>
          </span>
      
          <div class="form-box register">
            <h2>Register</h2>
            <form action="register.php" method="POST">
      
              <div class="input-box">
                <span class="icon"><ion-icon name="person"></ion-icon></span>
                <input type="text" name="username" required>
                <label for="text">Username</label>
              </div>
      
              <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <input type="email" name="email" required>
                <label for="email">Email</label>
              </div>
      
              <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name="password" required>
                <label for="password">Password</label>
              </div>
              <div class="remember-forget-pass">
                <label><input type="checkbox">I agree to the terms & conditions</label>
              </div>
              <button type="submit" class="submit-btn">Sign In</button>
              <div class="login-register">
                <p>Already have an Account?<a href="login.php" class="login-link">Login</a></p>
              </div>
            </form>
          </div>
      
    
      </section>
    </div>

      <div class="about-container">

        <div class="content-wrapper">

          <div class="flex-center-column about-wrapper">
            <div class="about-title-wrapper">
              <h1 class="about-title">About Us</h1>
            </div>
  
            <video
              id="my-video"
              class="video-js vjs-matrix"
              controls
              muted
              loop
              autoplay
              preload="auto"
              poster="./videos/background.jpg"
              data-setup="{}"
              >
                <source src="./videos/cinematic-about-us.mp4" type="video/mp4" />
                <p class="vjs-no-js">
                  To view this video please enable JavaScript, and consider upgrading to a
                  web browser that
                <a href="https://videojs.com/html5-video-support/" target="_blank"
                  >supports HTML5 video</a
                >
              </p>
  
            </video>
          </div>

          <div class="about-desc-wrapper">
            <h3>Welcome to YR<span>Fitness</span> ,</h3>
            <p> 
              -
            </p>
            <p>
              Welcome to YR Fitness,
              
              where fitness meets community in the heart of Cumilla, Bangladesh. At YR Fitness, we're more than just a gym - we're a wellness destination committed to empowering individuals on their fitness journey. Nestled in the vibrant neighborhoods of Cumilla, our state-of-the-art facility is designed to cater to fitness enthusiasts of all levels, from beginners to seasoned athletes. Our diverse range of cutting-edge equipment, expert trainers, and engaging classes ensure that every workout is a step towards a healthier, stronger, and happier you.
              
              What sets YR Fitness apart is our unwavering dedication to fostering a sense of community. In a city that thrives on connection, we understand the importance of creating a space where individuals can come together to pursue their fitness goals, share experiences, and build lasting relationships. Our gym isn't just a place to sweat; it's a supportive environment where you'll find like-minded individuals cheering you on every step of the way.
              
              Our team of certified trainers is here to guide and motivate you, offering personalized training programs that cater to your unique needs and aspirations. From high-intensity workouts to mindful yoga sessions, we offer a diverse range of classes that cater to different preferences and fitness levels. Whether you're looking to lose weight, build muscle, or simply maintain a healthy lifestyle, YR Fitness is your go-to destination for comprehensive and effective fitness solutions.
              
              At YR Fitness, we take pride in being a part of the rich tapestry of Cumilla's cultural landscape. We are not just a gym; we are a reflection of the vibrant and diverse community we serve. Join us at YR Fitness, where fitness is not just a routine – it's a lifestyle embraced by a community that values health, camaraderie, and the pursuit of individual and collective well-being. Your fitness journey begins here – welcome to the YR Fitness family!</p>

            
          </div>

        </div>

      </div>

    </main>

    <!-- Footer Section -->

    <footer class="footer" style="background-color: black; color: white; padding: 40px 20px;">
      <div class="footer-wrapper" style="display: flex; justify-content: space-between; align-items: center;">
    
        <!-- Gym Description Section (Left Side) -->
        <div class="footer-desc" style="flex: 1; min-width: 300px; text-align: center;">
          <h1 style="font-size: 24px;">
            <span style="color: white;">YR</span>
            <span style="color: rgb(255, 38, 0);">FITNESS</span>
          </h1>
          <p style="margin: 10px 0;">Empowering your fitness journey with state-of-the-art equipment, expert coaching, and a supportive environment to achieve your health goals.</p>
          <p><i class="fa-solid fa-location-dot footer-icon"></i> Back of New Market, Khandirpar, Cumilla</p>
          <p><i class="fa-solid fa-envelope footer-icon"></i> <a href="mailto:yrfitness@gmail.com" style="color: white; text-decoration: none;">yrfitness@gmail.com</a></p>
        </div>
    
        <!-- Empty Space (Middle Part) -->
        <div class="footer-empty" style="flex: 1;"></div>
    
        <!-- Owner Section (Right Side) -->
        <div class="footer-owner" style="flex: 1; min-width: 300px; text-align: center;">
          <h2 style="color: orange; font-size: 20px;">FOUNDERS</h2>
          <p>Pervej and Yeasin, the dynamic founders of YR Fitness, combined their shared passion for health and innovation to create a fitness hub like no other. With a focus on community and cutting-edge techniques, YR Fitness stands as a testament to their vision of empowering individuals to transform their lives through fitness</p>
        </div>
    
      </div>
    </footer>
    

  <div class="copyright">
    <p>Designed And Developed By YR Group </p>
  </div>

</body>


<script src="./js/mobile-menu.js"></script>
<script src="https://vjs.zencdn.net/8.6.1/video.min.js"></script>

<script>

  player.responsive(true);

</script>


<script src="./js/user-sign-in.js"></script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script defer src="./js/animation.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/gsap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/Flip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/Observer.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/ScrollToPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/Draggable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/MotionPathPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/EaselPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/PixiPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/TextPlugin.min.js"></script>

  
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/EasePack.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/CustomEase.min.js"></script>

</html>