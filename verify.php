<?php

	require "mail.php";
	require "functions.php";
	check_login();

	$errors = array();

	if($_SERVER['REQUEST_METHOD'] == "GET" && !check_verified()){

		//send email
		$vars['code'] =  rand(10000,99999);

		//save to database
		$vars['expires'] = (time() + (60 * 10));
		$vars['email'] = $_SESSION['USER']->email;

		$query = "insert into verify (code,expires,email) values (:code,:expires,:email)";
		database_run($query,$vars);

		$message = "Code yawe ni: " . $vars['code'];
		$subject = "Email verification";
		$recipient = $vars['email'];
		send_mail($recipient,$subject,$message);
	}

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		if(!check_verified()){

			$query = "select * from verify where code = :code && email = :email";
			$vars = array();
			$vars['email'] = $_SESSION['USER']->email;
			$vars['code'] = $_POST['code'];

			$row = database_run($query,$vars);

			if(is_array($row)){
				$row = $row[0];
				$time = time();

				if($row->expires > $time){

					$id = $_SESSION['USER']->id;
					$query = "update users set email_verified = email where id = '$id' limit 1";
					
					database_run($query);

					header("Location: profile.php");
					die;
				}else{
					echo "Code expired";
				}

			}else{
				echo "wrong code";
			}
		}else{
			echo "You're already verified";
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
        <h4 class="p-2 text-white  text-center">Assignment.</h4>
    </header>


    <main class="d-flex justify-content-center align-items-center" style="height: 90vh;">
        <div class="border pt-5 px-4 shadow-sm pb-8">
            <div class="position-relative text-center">
                <i class="fa fa-user-circle-o text-info position-absolute" style="font-size: 50px;top: -80px"></i>
                <h6 class="fw-bold">An email was sent to your address. paste the code from the email here</h6>
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
                 
                <!-- Verification Code -->
                <div class="row mt-2">
                    <div class="col">
                        <div class="position-relative">
                            <input type="text" name="code" id="" class="form-control ps-5" placeholder="Enter your Code">
                            <i class="fa fa-envelope position-absolute text-info" aria-hidden="true" style="top: 10px;left:10px;font-size: 20px"></i>
                        </div>
                    </div>
                </div>

                <!-- next button -->
                <div class="row mt-2">
                    <div class="col">
                        <input type="submit" class="w-100 btn btn-info text-white fw-bold rounded-pill" value="Verify Now">
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
                    <span>Sign Up Now?</span>
                    <a href="index.php" class="fw-bold text-danger" style="text-decoration: none;">SIGN UP</a>
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