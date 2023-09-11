<?php include './shared/loginhead.php'; 
?>

<div id="app">
  <?php
        if(isset($_SESSION['id']) && $_SESSION['user']['role'] == 0) {
            header('location: index.php');
        } else if(isset($_SESSION['id']) && $_SESSION['user']['role'] == 1) {
            header('location: ../back-end.php/index.php');
        }
          
        ?>

  <!-- Breadcrumb Section Start -->
  <div class="login-container">
        <div class="left-side">
            <!-- Place your chicken shop logo here -->
            <a href="index.php"><img class="logo" src="../assets/images/friedlogo1.jpg" alt="Chicken Shop Logo"></a>
        </div>
        <div class="right-side" >
            <div class="login-form" >
            <h2 class="typing-text">Welcome to CJ Fried Chicken<span class="cursor"></span></h2>
                <form @submit='login'>
                    <div class="form-group">
                        <input type="email" name="username" required>
                        <label for="username">Email</label>
                    </div>
                    
                                <div class="form-group">
                <input type="password" name="password" id="idpassword" required>
                <label for="password">Password</label>
                <span class="password-toggle" onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye"></i>
                </span>
                <p  class="error"id="message error"> {{error}} </p>
            </div>


                    <div class="button-container">
                        <button type="submit">Login</button>
                           <a class="forgot-password" onclick="location.href='sign-up.php';">Sign Up</a>
                    </div>
                </form>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>
        </div>
    </div>

   


<?php include './shared/scripts.php'; ?>
<script src="../src/user.js"></script>

<script>
        // JavaScript to add 'has-content' class to form fields with content
        const formFields = document.querySelectorAll('input[type="email"], input[type="password"]');

        formFields.forEach((field) => {
            field.addEventListener('input', () => {
                if (field.value !== '') {
                    field.classList.add('has-content');
                } else {
                    field.classList.remove('has-content');
                }
            });
        });

        function togglePasswordVisibility() {
        const passwordInput = document.getElementById('idpassword');
        const toggleIcon = document.querySelector('.password-toggle i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
    

    </script>

</body>

</html>