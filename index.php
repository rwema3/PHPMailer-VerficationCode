<?php  

require "functions.php";

$errors = array();

if($_SERVER['REQUEST_METHOD'] == "POST")
{

	$errors = signup($_POST);

	if(count($errors) == 0)
	{
		header("Location: login.php");
		die;
	}
}

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
        <h4 class="p-2 text-white  text-center">PHPMailer -Verfication code.</h4>
    </header>


    <main class="d-flex justify-content-center align-items-center" style="height: 90vh;">
        <div class="border pt-5 px-4 shadow-sm pb-8">
            <div class="position-relative text-center">
                <i class="fa fa-user-circle-o text-info position-absolute" style="font-size: 50px;top: -80px"></i>
                <h6 class="fw-bold">Create an account</h6>
                <hr>

                <?php if(count($errors) > 0):?>
				<?php foreach ($errors as $error):?>
					<?= $error?> <br>	
				<?php endforeach;?>
			<?php endif;?>
            
            </div>

            <!-- first and last name -->

            <form method="post">
                
                <div class="row g-2">
                    <div class="col">
                        <div class="position-relative">
                            <input type="text" name="firstname" id="" class="form-control ps-5" placeholder="First name">
                            <i class="fa fa-user position-absolute text-info" aria-hidden="true" style="top: 10px;left:10px;font-size: 20px"></i>
                        </div>
                    </div>

                    <div class="col">
                        <div class="position-relative">
                            <input type="text" name="lastname" id="" class="form-control ps-5" placeholder="Last name">
                            <i class="fa fa-user position-absolute text-info" aria-hidden="true" style="top: 10px;left:10px;font-size: 20px"></i>
                        </div>
                    </div>
                </div>

                <!-- email -->
                <div class="row mt-2">
                    <div class="col">
                        <div class="position-relative">
                            <input type="text" name="email" id="" class="form-control ps-5" placeholder="Email">
                            <i class="fa fa-envelope position-absolute text-info" aria-hidden="true" style="top: 10px;left:10px;font-size: 20px"></i>
                        </div>
                    </div>
                </div>

                <!-- password -->
                <div class="row mt-2">
                    <div class="col">
                        <div class="position-relative">
                            <input id="pass-input" type="password" name="password" id="" class="form-control ps-5" placeholder="Choose Password">
                            <i class="fa fa-key position-absolute text-info" aria-hidden="true" style="top: 10px;left:10px;font-size: 20px"></i>
                            <i id="hint" class="fa fa-eye position-absolute text-info" aria-hidden="true" style="top: 10px;right:10px;font-size: 20px; cursor:pointer"></i>
                        </div>
                    </div>
                </div>

                <!-- next button -->
                <div class="row mt-2">
                    <div class="col">
                        <input type="submit" class="w-100 btn btn-info text-white fw-bold rounded-pill" value="Register">
                    </div>
                </div>

                <!-- or dsgn -->
                <div class="d-flex align-items-center py-2 px-5">
                    <div class="border w-100"></div>
                    <span class="px-3">or</span>
                    <div class="border w-100"></div>
                </div>

                <!--Option continue with google -->

                <div class="bg-danger p-2 text-white rounded">
                    <i class="fa fa-google" aria-hidden="true"></i>
                    <span class="ps-2">Continue with google</span>
                </div>

                <!-- to one having an account -->
                <div class="text-danger text-center pt-2">
                    <span>Already have an account?</span>
                    <a href="login.php" class="fw-bold text-danger" style="text-decoration: none;">SIGN IN</a>
                </div>

            </form>
        </div>
    </main>


    <footer class="d-flex bg-info text-white p-2 justify-content-between fixed-bottom">
        <div>
            <a href="#" class="text-white px-2" style="text-decoration: none;">About Us</a>
            <a href="#" class="text-white px-2" style="text-decoration: none;">Advertisement</a>
        </div>
        <div>
            <a href="#" class="text-white px-2" style="text-decoration: none;">Rwema Bagirishya</a>
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