<?php 
session_start();

// Get the username from the URL if available, otherwise use session
$username = isset($_GET['username']) ? htmlspecialchars($_GET['username']) : (isset($_SESSION['username']) ? $_SESSION['username'] : null);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="YR Fitness Front Page">
	<meta name="keywords" content="front page">
	<meta name="author" content="Nikola Štefančić">
  <title>YR Fitness | Home</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  

  <link rel="stylesheet" href="./styles/general.css">
  <link rel="stylesheet" href="./styles/header.css">
  <link rel="stylesheet" href="./styles/footer.css">
  <link rel="stylesheet" href="./styles/index.css">
  <link rel="stylesheet" href="./styles/user-sign.css">
  <link rel="stylesheet" href="./styles/animations.css">

  <link rel="icon" type="image/x-icon" href="./logos/sparta-logo-red.png">
  <script src="https://code.ionicframework.com/ionicons/5.5.2/ionicons.min.js"></script>

  <style>
    /* Chatbot Icon */
    #chatbot-icon {
      position: fixed;
      bottom: 20px;
      right: 20px;
      cursor: pointer;
      z-index: 1000;
    }

    #chatbot-icon img {
      width: 50px;
      height: 50px;
    }

    #chatbot-icon:hover {
      opacity: 0.8;
    }

    /* Chatbot Interface */
    #chatbot-container {
      position: fixed;
      bottom: 80px;
      right: 20px;
      width: 360px; /* Increased by 20% */
      max-height: 480px; /* Increased by 20% */
      background-color: #000; /* Theme color */
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      display: none;
      flex-direction: column;
      z-index: 1000;
    }

    #chatbot-container h3 {
      margin: 0;
      padding: 10px;
      background-color: #ff2600; /* Theme color */
      color: white;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }

    #chatbot-messages {
      flex: 1;
      padding: 10px;
      overflow-y: auto;
      background-color: #000; /* Theme color */
      color: #fff; /* Text color */
    }

    #chatbot-messages div {
      margin-bottom: 10px;
    }

    #chatbot-messages div strong {
      display: block;
      margin-bottom: 5px;
    }

    #chatbot-input {
      width: calc(100% - 20px);
      padding: 10px;
      margin: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #fff; /* Input background color */
      color: #000; /* Input text color */
    }

    #chatbot-send {
      width: calc(100% - 20px);
      padding: 10px;
      margin: 10px;
      background-color: #ff2600; /* Theme color */
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    #chatbot-send:hover {
      background-color: #e60000; /* Darker theme color */
    }
  </style>

</head>
<body>
  
  <!-- Header Navbar Section -->

  <header>
    <nav class="navbar">
        <a href="index.php"><img src="./logos/sparta-logo-red.png" alt="envizion-logo" class="navbar-logo logo-animate"></a>
        <a href="index.php"><h1 class="logo-animate">YR <span>Fitness</span></h1></a>

        <div class="navbar-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>

        <div class="navbar-menu navbar-animate">
        <a href="index.php" class="navbar-link underline">Home</a>
        <a href="news.php" class="navbar-link">News</a>
        <a href="services.php" class="navbar-link">Services</a>
        <a href="group-programs.php" class="navbar-link ">GroupPrograms</a>
        <a href="membership.php" class="navbar-link ">Memberships</a>
        <a href="store.php" class="navbar-link">Store</a>
        <a href="about-us.php" class="navbar-link">AboutUs</a>
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

    <!-- Hero Section -->

    <section class="hero">

      <div class="hero-content">

        <h1 class="hero-title-animate">Focus in <span class="delay-span-animate">Mind</span>,Power in  <span class="delay-span-animate">Motion</span></h1>
        <h1 class="hero-title-animate-2">Stronger Every Day, Together</h1>
        <p class="hero-animate-p">Join the Movement!</p>
        <a href="./membership.php" class="get-started-btn gsap-animate-btn">Get Started</a>

      </div>

    </section>


    <!-- Services Section -->

    <section class="services">

      <div class="services-container">

        <div>

          <div class="hiddenLeft">

            <p class="topline">Features</p>
            <h1 class="services-heading">
            What We Offer 
            </h1>

          </div>

          <div class="services-features hiddenLeft">

            <p class="services-feature delay hiddenLeft">
              <i class="fa-solid fa-clock services-icon"></i>
              24/7 Access
            </p>

            <p class="services-feature delay hiddenLeft">
              <i class="fa-solid fa-user-group services-icon"></i>
              Personal Training Sessions
            </p>

            <p class="services-feature delay hiddenLeft">
              <i class="fa-solid fa-dumbbell services-icon"></i>
              Top quality equipment
            </p>

            <p class="services-feature delay hiddenLeft">
              <i class="fa-solid fa-person-swimming services-icon"></i>
              Cafe
            </p>
            <p class="services-feature delay hiddenLeft">
              <i class="fa-solid fa-person-swimming services-icon"></i>
              Yoga
            </p>
            <p class="services-feature delay hiddenLeft">
              <i class="fa-solid fa-person-swimming services-icon"></i>
              Steam Room
            </p>



          </div>

        </div>

        <div>
          <img src="./images/hero-background-2.jpg" alt="" class="services-img img-animate-top-right">
        </div>

        <div>
          <img src="./images/hero-background-4.jpg" alt="" class="services-img img-animate-bottom-left">
        </div>

        <div>
          <img src="./images/hero-background-3.jpg" alt="" class="services-img img-animate-bottom-right">
        </div>


      </div>

    </section>

    <!-- Membership Section -->

    <section class="memberships">
      <h1>Our Membership Plans</h1>
      <p>Start today with <span class="membership-style">Gold</span> or <span class="membership-style">Diamond</span> and receive 25% off your first month</p>

      <div class="membership-wrapper hiddenTop">

        <div class="membership-card silver-member">

          <div class="membership-title">

            <i class="fas fa-dumbbell card-icon"></i>
            <h3>Silver</h3>

          </div>
          <div class="membership-perks">

            <p><span class="price-style">800</span>Taka/month</p>
            <p>Gain access to the gym room</p>
            <p>Yoga classes</p>

          </div>

          <?php if ($username): ?>
            <a href="./membership.php" class="get-started-btn membership-btn">BUY NOW</a>
          <?php else: ?>
            <button class="login-btn get-started-btn membership-btn">SIGN UP</button>
          <?php endif; ?>
          
        </div>

        <div class="membership-card gold-member">

          <div class="membership-title">

            <i class="fa-solid fa-medal card-icon"></i>
            <h3>Gold</h3>
            <div class="card-absolute">
              <p>Top Choice</p>
    
            </div>

          </div>
          <div class="membership-perks">

            <p><span class="price-style">1200</span>Taka/month</p>
            <p>Gain access to the gym room</p>
            <p>Yoga classes</p>
            <p>Access to Treadmills</p>

          </div>

          <?php if ($username): ?>
            <a href="./membership.php" class="get-started-btn membership-btn">BUY NOW</a>
          <?php else: ?>
            <button class="login-btn get-started-btn membership-btn">SIGN UP</button>
          <?php endif; ?>

        </div>

        <div class="membership-card diamond-member">

          <div class="membership-title">

            <i class="fa-solid fa-diamond card-icon"></i>
            <h3>Diamond</h3>

          </div>
          <div class="membership-perks">

            <p><span class="price-style">2000</span>Taka/month</p>
            <p>Access to everything we offer!</p>

          </div>

          <?php if ($username): ?>
            <a href="./membership.php" class="get-started-btn membership-btn">BUY NOW</a>
          <?php else: ?>
            <button class="login-btn get-started-btn membership-btn">SIGN UP</button>
          <?php endif; ?>

        </div>
      </div>
    </section>

    <!-- Personal Trainers Section -->

    <section class="team">
      <div class="team-wrapper">

        <div class="team-text animate-team">
          <p class="topline">Private Coaching</p>
          <h1>Meet our Trainers</h1>
          <p class="team-desc">
            Our hired trainers have 5 years of experience combined.
            Each trainer is specialized in strength and mobility training 
          </p>
        </div>

        
        

        <div class="team-card animate-team">
          <p>Meem</p>
          <img src="./images/trainer-5.jpg" alt="trainer-2" class="team-img" title="Lucia | Personal Trainer">
        </div>
        

        <div class="team-card animate-team">
          <p>Tamim</p>
          <img src="./images/trainer-4.png" alt="trainer-3" class="team-img" title="Michael | Personal Trainer">
        </div>

        

       

       
       

      </div>
    </section>
    <!-- Review Section -->
     <!-- Review Section -->
    
     <body>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </body>
    
    <div id="reviews-container"></div>

    <script>
      $(document).ready(function() {
        $('#reviews-container').load('reviews.php');
      });
    </script>


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
  <script src="./js/mobile-menu.js"></script>
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

  <!-- Chatbot Icon -->
  <div id="chatbot-icon">
    <img src="./images/chatbot-icon.png" alt="Chatbot">
  </div>
  <!-- Chatbot Interface -->
  <div id="chatbot-container">
    <h3>YR Fitness Chatbot</h3>
    <div id="chatbot-messages"></div>
    <input type="text" id="chatbot-input" placeholder="Type your message...">
    <button id="chatbot-send">Send</button>
  </div>

  <script>
    async function handleChat() {
      const userInput = document.getElementById('chatbot-input').value;
      if (!userInput) return;

      // Add user message to chat
      const chatMessages = document.getElementById('chatbot-messages');
      chatMessages.innerHTML += `<div><strong>You:</strong> ${userInput}</div>`;

      // Clear input
      document.getElementById('chatbot-input').value = '';

      try {
        const response = await fetch(`https://free-chatgpt-api.p.rapidapi.com/chat-completion-one?prompt=${encodeURIComponent(userInput)}`, {
          method: 'GET',
          headers: {
            'x-rapidapi-key': '4493aab807msh45647abc52b0d66p16e897jsn0a70f00705cc',
            'x-rapidapi-host': 'free-chatgpt-api.p.rapidapi.com'
          }
        });

        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }

        const result = await response.json(); // Parse as JSON
        const aiMessage = result.response; // Access the response field

        // Add AI message to chat
        chatMessages.innerHTML += `<div><strong>YR Fitness Assistant:</strong> ${aiMessage}</div>`;

        // Scroll to bottom of chat
        chatMessages.scrollTop = chatMessages.scrollHeight;
      } catch (error) {
        console.error('Error:', error);
        chatMessages.innerHTML += `<div><strong>YR Fitness Assistant:</strong> Sorry, something went wrong. Please try again later.</div>`;
      }
    }

    // Add event listener for Enter key
    document.getElementById('chatbot-input').addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        handleChat();
      }
    });

    document.getElementById('chatbot-send').addEventListener('click', handleChat);

    document.getElementById('chatbot-icon').addEventListener('click', function() {
      const chatbotContainer = document.getElementById('chatbot-container');
      const displayStyle = getComputedStyle(chatbotContainer).display;
      if (displayStyle === 'none') {
        chatbotContainer.style.display = 'flex';
      } else {
        chatbotContainer.style.display = 'none';
      }
    });
  </script>

</body>





</html>