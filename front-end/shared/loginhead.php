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

  <!-- Template css -->
  <link id="color-link" rel="stylesheet" type="text/css"
    href="../assets/css/style.css">
  <style>
       /* Reset some default styles */
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: white; /* Light yellow background color */
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
.error{
  color:red;
  font-size:20px;
}
/* Style the login container */
.login-container {
    background-color: transparent; /* Transparent background color */
    display: flex;
    max-width: 1000px; /* Adjust the maximum width as needed */
    width: 130%;
    overflow: hidden;
    margin: 20px; /* Add some margin for spacing */
}

/* Style the left side with the logo */
.left-side {
    flex: 1;
    padding: 40px;
    background-color: white; /* Chicken shop theme color */
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 30px; /* Add margin to separate the sides */
    position: relative; /* Position the pseudo-element relative to the left-side div */
}

/* Create a pseudo-element for the right margin */
.left-side::after {
    content: "";
    position: absolute;
    width: 20px; /* Adjust the width of the margin */
    top: 0;
    right: -50px; /* Adjust the position to create a right margin */
    height: 100%;
    background-color: transparent !important; /* Make the margin transparent */
}

/* Style the logo */
.logo {
    max-width: 100%;
    height: auto;
}

/* Style the right side with the login form */
.right-side {
    flex: 1;
    padding: 40px;
    background: white;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Style the login form */
.login-form {
    background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
    border-radius: 10px;
    padding: 60px;
    backdrop-filter: blur(3px);
    box-sizing: border-box;
    box-shadow: 0 15px 25px grey;
}

.login-form h2 {
    color: #ff9900; /* Chicken shop theme color */
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
}

/* Style form elements */
.form-group {
    margin-bottom: 20px;
    position: relative;
}

label {
    display: block;
    font-weight: bold;
    color: #333; /* Label color */
    font-size: 16px;
    transition: transform 0.2s ease-out, font-size 0.2s ease-out, top 0.2s ease-out;
    transform-origin: left bottom;
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
}

input[type="text"],
input[type="email"],
input[type="password"] {
    padding: 12px;
    border: 1px solid #ccc; /* Border color */
    border-radius: 5px;
    outline: none;
    font-size: 16px;
    width: 100%;
    padding-top: 24px; /* Create space for the label */
}

/* Add a hover effect to input fields */
input[type="text"]:hover,
input[type="email"]:hover,
input[type="password"]:hover {
    border-color: #ff9900; /* Highlight border color on hover */
}

/* Move the label to the top when input field is focused or has content */
input[type="text"]:focus + label,
input[type="email"]:focus + label,
input[type="password"]:focus + label,
input[type="text"].has-content + label,
input[type="email"].has-content + label,
input[type="password"].has-content + label {
    transform: translateY(-100%) scale(0.8);
    font-size: 14px;
    top: 0;
}

.password-toggle {
    position: absolute;
    top: 55%;
    right: 18px;
    font-size: 15px;
    transform: translateY(-50%);
    cursor: pointer;
    background: white;
}

button {
    background-color: #ff9900; /* Chicken shop theme color */
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    font-size: 18px;
    width: 100%;
    transition: background-color 0.3s;
    margin-bottom: 10px; /* Add spacing between buttons */
}

button:hover {
    background-color: #ff8c00; /* Darker shade of the theme color on hover */
}

/* Style for forgot password link */
.forgot-password,
a {
    color: #ff9900; /* Chicken shop theme color */
    text-decoration: none;
    font-weight: bold;
    text-align: center;
    display: block;
    margin-top: 10px;
    font-size: 16px;
}
/* Add this CSS to your stylesheet */
.typing-text {
    overflow: hidden; /* Hide overflowing characters */
    white-space: nowrap; /* Prevent text from wrapping */
    animation: typeText 2s steps(40, end), blinkCursor 0.2s step-end infinite;
}

@keyframes typeText {
    from {
        width: 0;
    }
    to {
        width: 100%;
    }
}

@keyframes blinkCursor {
    from, to {
        border-right-color: transparent;
    }
    50% {
        border-right-color: #000; /* Change to the desired cursor color */
    }
}

  </style>
</head>

<body class="theme-color-1">
<?php 

include './shared/loader.php';
?>