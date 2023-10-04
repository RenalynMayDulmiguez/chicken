<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fried Chicken</title>

  <!-- Google font -->
  <link rel="preconnect" href="https://fonts.gstatic.com/">
  <link
    href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Pacifico&amp;display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Kaushan+Script&amp;display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap"
    rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- bootstrap css -->
  <link id="rtl-link" rel="stylesheet" type="text/css"
    href="../assets/css/vendors/bootstrap.css">

  <!-- wow css -->
  <link rel="stylesheet" href="../assets/css/animate.min.css" />

  <!-- feather icon css -->
  <link rel="stylesheet" type="text/css"
    href="../assets/css/vendors/feather-icon.css">

  <!-- slick css -->
  <link rel="stylesheet" type="text/css"
    href="../assets/css/vendors/slick/slick.css">
  <link rel="stylesheet" type="text/css"
    href="../assets/css/vendors/slick/slick-theme.css">

  <!-- Iconly css -->
  <link rel="stylesheet" type="text/css" href="../assets/css/bulk-style.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <!-- Template css -->
  <link id="color-link" rel="stylesheet" type="text/css"
    href="../assets/css/style.css">
  <style>
  .open {
    display: block;
  }
  .password-toggle {
    position: absolute;
    right: 20px;
    top: 20px;
    width: 30px;
    cursor: pointer;
    font-size: 20px;
    color: skyblue;
  }
  .password-toggle-container {
    position: relative;
    display: flex;
  }
  .about-photo {
            width: 100%;
            height: 400px; /* Set your desired height */
            background-position: center;
            background-size: cover;
            animation: slide 8s infinite;
        }

        @keyframes slide {
            0%, 100% {
                transform: translateX(0%);
            }
            25% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(-200%);
            }
            75% {
                transform: translateX(-300%);
            }
        }
        
        .swiper-container {
            position: relative;
        }

        .swiper-slide {
            position: relative;
            text-align: center;
        }

        .image-container {
            position: relative;
            width: 100%;
            max-width: 100%;
            height: auto;
        }

        .image-container::before {
            content: "";
            position: absolute;
            right: 50%;
            left: 50%;
            width:50%;
            height: 200%;
            transform: translate(-50%, -50%);
            background: linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3));
            z-index: 1; /* Position the gradient layer above the image */
            pointer-events: none; /* Allows interaction with the underlying image */
        }
        .swiper-slide img {
            width: 50%;
            height: 50%;
            margin: 0 auto; 
            display: block; 
        }

        .swiper-slide .image-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        
            color: white;
            padding: 10px;
        }
        /* CSS for the text elements */
          .image-text p {
          font-size: 35px;
          font-weight: bold;
          text-transform: uppercase;
          font-family:  emoji;
      }

        /* CSS for the 'Order Now' button */
        .image-text a.btn {
            display: inline-block;
            background: #FF4C4C; 
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            padding: 10px 20px;
            margin-top: 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .image-text a.btn:hover {
            background: #FF3333; 
        }
        .swiper-pagination-custom {
            text-align: center; 
            margin-top: 10px; 
        }

        .swiper-pagination-custom .swiper-pagination-bullet {
            background: transparent; 
            width: 12px; 
            height: 12px; 
            margin: 0 5px; 
        }
  </style>
</head>

<body class="theme-color-1">
  <?php 
  //  session_start();

include './shared/loader.php';
?>