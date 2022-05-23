<?php

	require "functions.php";
	check_login();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="index.js"></script>
    <title>Welcome</title>
</head>

<body>

    <!-- header -->
    <header style="background-color: red">
        <h4 class="p-2 text-white  text-center">Assignment.</h4>
    </header>


    <main class="d-flex justify-content-center align-items-center" style="height: 90vh;">
        <div class="border pt-5 px-4 shadow-sm pb-8">
            <div class="position-relative text-center">
                <i class="fa fa-user-circle-o text-info position-absolute" style="font-size: 50px;top: -80px"></i>
                <h6 class="fw-bold">Warm Welcome</h6>
                <hr>

 <?php if(check_login(false)):?>

	 Hi, <?=$_SESSION['USER']->firstname?>

	 <br><br>

	 <?php if(!check_verified()):?>

		 <a href="verify.php">
		 <div class="bg-danger p-2 text-white rounded">
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <span class="ps-2">verify Acount First</span>
                </div>
		 </a>

	 <?php endif;?>
 <?php endif;?>

    </main>


    <footer class="d-flex bg-info text-white p-2 justify-content-between fixed-bottom">
        <div>
            <a href="#" class="text-white px-2" style="text-decoration: none;">About Us</a>
            <a href="#" class="text-white px-2" style="text-decoration: none;">Advertisement</a>
        </div>
        <div>
            <a href="#" class="text-white px-2" style="text-decoration: none;">Kigali, Rwanda</a>
        </div>
        <div>
            <a href="#" class="text-white px-2" style="text-decoration: none;">How search work</a>
            <a href="#" class="text-white px-2" style="text-decoration: none;">Privacy</a>
        </div>
    </footer>

    <!-- Make password visible or invisible through click: -->

    <script>
        let icon = document.querySelector("#hint");
        let inputBox = document.querySelector("#pass-input");

        icon.addEventListener('click', function() {
            let state = inputBox.type;
            if(state == 'password') 
            {
                state = 'text';
                icon.classList.replace('fa-eye','fa-eye-slash');
            } 
        else 
            {
                state = 'password';
                icon.classList.replace('fa-eye-slash','fa-eye');
            }
            inputBox.type = state;
        });
    </script>

</body>

</html>