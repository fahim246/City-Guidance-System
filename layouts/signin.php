<?php require_once "controllerUserData.php"; ?>

<?php

require_once './vendor/autoload.php';
include 'connection.php';

$clientId = "1025198180720-1l5m94m2qdgirahqam3i9p7vc4v1hcri.apps.googleusercontent.com";
$clientSecret = "SjY3-_CyVItkXx2u6QKmp44a";
$redirectUri = "http://localhost/Radin_city/layouts/signin.php";

$client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {

   
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
    $oAuth = new Google_Service_Oauth2($client);
    $userData = $oAuth->userinfo->get();


    $email = $userData->email;
    $_SESSION['email'] = $email;
    $name = $userData->name;
    $picture = $userData->picture;
    $_SESSION['name'] = $name;
    $_SESSION['pic'] = $picture;


    if ($name == "Saimon Akram") {
        // $email_check = "SELECT * FROM registration WHERE email = '$email' ";
        // $res = mysqli_query($con, $email_check);
        // if (mysqli_num_rows($res) > 0) {
        //     echo '<script>console.log("Message Send asdfsadf")</script>';
        //     $insert_data = "INSERT INTO registration (firstname,email, created_on)
        //     values('$name;','$email' ,'$now')";
    
        //     $data_check = mysqli_query($con, $insert_data);
    
        // }
       header('location:./admin/dashboard.php');
    } else {
        header('location:./user/home.php');
    }

    // echo "<h1>$picture</h1>";
    // echo "<h1>$name</h1>";
    // echo "<h1>$email</h1>";

} else {
    # code...
    $login_url = $client->createAuthUrl();

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>City Guidance System</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/styles.css">
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <style>
            /* .login-form .btn-warning {
    background: #36A420;
    border: 1px solid #36A420;
    color: aliceblue;
    font-size: 17px;
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 7px;
    text-transform: capitalize; */
            .modal h2 {
                font-size: 32px;
                font-weight: bold;
                margin-bottom: 0;
            }

            .modal .modal-title p {
                color: #606770;
                font-size: 15px;
                line-height: 24px;
                margin-bottom: 0;

            }

            .modal .dob {
                color: #606770;
                font-size: 12px;
                line-height: 20px;
                margin-bottom: 0;

            }

            .modal p>input {
                float: right;

            }

            .modal-content {
                width: 80% !important;
            }

            .modal p.footer {
                color: #777;
                font-size: 11px;

            }

            .modal p.footer>a {
                color: #385898;
                text-decoration: none;

            }

            .modal .btn-success {
                padding: 4px 60px;
                background: #42B72A;
                border: 1px solid #42B72A;
                font-weight: bold;
                font-size: 19px;
            }

            .modal input.form-control {
                background: #F5F6F7;
            }
        </style>
    </head>

    <body>
        <section class="flex flex-col md:flex-row h-screen items-center">

            <div class="hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
            
                <img src="../images/sea-3243357_1280.jpg" alt="" class="w-full h-full object-cover">
                
            </div>

            <div class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
              flex items-center justify-center">

                <div class="w-full h-100">


                    <h1 class="text-xl md:text-2xl font-bold leading-tight mt-3">Log in to your account</h1>

                    <form class="mt-6" action="signin.php" method="POST">
                        <?php
                        if (count($errors) > 0) {
                        ?>
                            <div class="alert alert-danger text-center">
                                <?php
                                foreach ($errors as $showerror) {
                                    echo $showerror;
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <div>
                            <label class="block text-gray-700">Email Address</label>
                            <input type="email" name="email" id="" placeholder="Enter Email Address" class="w-full py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" autofocus autocomplete required value="<?php echo $email ?>">
                        </div>

                        <div class="mt-4">
                            <label class="block text-gray-700">Password</label>
                            <input type="password" name="password" id="pass" placeholder="Enter Password" minlength="6" class="w-full py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                      focus:bg-white focus:outline-none" required>



                        </div>

                        <div class=" mt-2">
                            <div> <input type="checkbox" onclick="myFunction1()"><span class="px-1">Show Password</span></div>

                        </div>

                        <button type="submit" class="w-full block bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 text-white font-semibold rounded-lg px-4 py-3 mt-2 mb-2" name="login" value="Login">Log In</button>
                        <div class="text-center">
                            <a href="forgot-password.php" class="text-sm font-semibold text-gray-700 hover:text-blue-700 focus:text-blue-700">Forgot Password?</a>
                        </div>
                    </form>

                    <hr class="my-2 border-gray-300 w-full">

                    <a href="<?php echo $login_url; ?> " class="w-full block bg-white hover:bg-gray-100 focus:bg-gray-100 text-gray-900 font-semibold rounded-lg px-4 py-3 border border-gray-300">
                        <div class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-6 h-6" viewBox="0 0 48 48">
                                <defs>
                                    <path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z" />
                                </defs>
                                <clipPath id="b">
                                    <use xlink:href="#a" overflow="visible" />
                                </clipPath>
                                <path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z" />
                                <path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z" />
                                <path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z" />
                                <path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z" />
                            </svg>
                            <span class="ml-4">
                                Log in
                                with
                                Google</span>
                        </div>
                    </a>

                    <p class="mt-4">Need an account?
                    <div class="link login-link text-center"> <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#signUP">Create new account</button></div>
                    </p>


                </div>
            </div>


        </section>


        <!-- Modal -->

        <div class="modal fade" id="signUP">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h2>Sign Up</h2>
                            <p>It's quick and easy.</p>
                            <?php
                            if (count($errors) == 1) {
                            ?>
                                <div class="alert alert-danger text-center">
                                    <?php
                                    foreach ($errors as $showerror) {
                                        echo $showerror;
                                    }
                                    ?>
                                </div>
                            <?php
                            } elseif (count($errors) > 1) {
                            ?>
                                <div class="alert alert-danger">
                                    <?php
                                    foreach ($errors as $showerror) {
                                    ?>
                                        <li><?php echo $showerror; ?></li>
                                    <?php
                                    }
                                    ?>
                                </div>
                            <?php
                            }
                            ?>

                            <!-- <script>
validateForm() {
//   var x = document.forms["myForm"]["email"].value;
  var y = "<?php echo $errors; ?>";
  if (count(y)>0) {
    alert("Error occurred");
    return false;
  }
}
</script> -->

                        </div>

                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="signin.php" onsubmit="return validateForm()" method="POST" autocomplete="" enctype="multipart/form-data">
                            <div class="form-row my-3">
                                <div class="col">
                                    <input type="text" class="form-control" name="firstname" placeholder="First name" required>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="lastname" placeholder="Last name" required>
                                </div>
                            </div>
                            <div class="form-row my-3">
                                <div class="col">
                                    <input type="text" class="form-control" name="email" placeholder="Email address" required>

                                </div>
                            </div>
                            <div class="form-row my-3">
                                <div class="col">
                                    <input type="password" class="form-control" name="password" placeholder="New password" id="new_pass" required>


                                </div>
                                <div class="col">
                                    <input type="password" class="form-control" name="cpassword" placeholder="Re password" id="re_pass" required>
                                    <script>
                                        function myFunction() {
                                            var x = document.getElementById("new_pass");
                                            var y = document.getElementById("re_pass");
                                            if (x.type === "password" && y.type === "password") {
                                                x.type = "text";
                                                y.type = "text";
                                            } else {
                                                x.type = "password";
                                                y.type = "password";
                                            }
                                        }
                                    </script>
                                </div>
                            </div>
                            <input type="checkbox" onclick="myFunction()"> Show Password

                            <div class="form-row my-3">
                                <div class="col">
                                    <label class="dob">Gender ?</label>
                                </div>
                            </div>
                            <div class="form-row my-3">
                                <div class="col">
                                    <p class="form-control">Female <input type="radio" id="Female" name="Gender" value="Female"></p>

                                    <!-- <input type="radio" id="Female" name="Gender" value="Female">
                                    <label for="female">Female</label><br> -->

                                </div>
                                <div class="col">
                                    <p class="form-control">Male <input type="radio" id="Male" name="Gender" value="Male"></p>
                                    <!-- <input type="radio" id="Male" name="Gender" value="Male">
                                    <label for="css">Male</label><br> -->
                                </div>
                                <div class="col">
                                    <p class="form-control">Custom <input type="radio" id="Custom" name="Gender" value="Custom"></p>
                                    <!-- <input type="radio" id="Custom" name="Gender" value="Custom">
                                    <label for="Custom">Custom</label> -->
                                </div>
                            </div>
                            <div class="form-row my-3">

                            </div>
                            <div class="form-row my-3">
                                <div class="col text-center">
                                    <input class="btn btn-success" type="submit" onclick="validateForm()" name="submit" value="Sign Up">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function myFunction1() {
                var x = document.getElementById("pass");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
        <!-- <footer class="bg-gray-900 pt-12 text-white"> 
            <div class="container mx-auto px-4"> 
                <div class="flex flex-wrap -mx-4"> 
                    <div class="w-full p-4 xl:w-4/12"> 
                        <a href="#" class="font-semibold hover:text-gray-400 inline-block mb-6 mr-auto text-3xl uppercase">                 Company </a> 
                        <p class="mb-4">                             Duis pharetra venenatis felis, ut tincidunt ipsum consequat nec. Fusce et porttitor libero, eu aliquam nisi. Nam finibus ullamcorper semper. </p> 
                        <div class="mb-6"> 
                            <a href="#" class="hover:text-gray-400">+1 234 567-890</a> 
                            <br> 
                            <a href="#" class="hover:text-gray-400">hello@company.com</a> 
                        </div>                         
                    </div>                     
                    <div class="p-4 w-full sm:w-6/12 md:w-3/12 xl:w-2/12"> 
                        <h2 class="font-normal mb-8 text-lg uppercase">                             About </h2> 
                        <ul> 
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">Get Quote</a> 
                            </li>                             
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">Enterprise Plan</a> 
                            </li>                             
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">Become an Affiliate</a> 
                            </li>                             
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">Our Portfolio</a> 
                            </li>                             
                        </ul>                         
                    </div>                     
                    <div class="p-4 w-full sm:w-6/12 md:w-3/12 xl:w-2/12"> 
                        <h2 class="font-normal mb-8 text-lg uppercase">                             Services </h2> 
                        <ul> 
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">Web Design</a> 
                            </li>                             
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">Web Development</a> 
                            </li>                             
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">WordPress</a> 
                            </li>                             
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">Digital Marketing</a> 
                            </li>                             
                            <li class="mb-4"> 
                                <a href="#" class="hover:text-gray-400">Content Writing</a> 
                            </li>                             
                        </ul>                         
                    </div>                     
                    <div class="p-4 w-full md:w-6/12 xl:w-4/12"> 
                        <h2 class="font-normal mb-8 text-lg uppercase">Subscribe</h2> 
                        <p class="mb-4">                             Subscribe to our newsletter and get exclusive updates directly in your inbox. </p> 
                        <form> 
                            <div class="bg-white border-2 border-gray-400 flex items-center mb-6 overflow-hidden p-1"> 
                                <input class="appearance-none border-blue-600 flex-1 font-light outline-none p-2 text-gray-600 w-full" placeholder="Enter email..." type="email"/> 
                                <a href="#" class="bg-blue-600 font-medium hover:bg-blue-700 inline-block px-6 py-2 text-center text-white uppercase" aria-label="submit"><svg viewBox="0 0 24 24" fill="currentColor" class="h-4 inline-block w-4"> 
                                        <path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"/> 
                                    </svg></a> 
                            </div>                             
                        </form>                         
                        <h2 class="font-bold mb-4 text-lg uppercase">Get Social</h2> 
                        <div class="flex-wrap inline-flex space-x-3"> 
                            <a href="#" class="hover:text-blue-400" aria-label="facebook link"> <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"> 
                                    <path d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4v-8.5z"/> 
                                </svg></a> 
                            <a href="#" class="hover:text-blue-400" aria-label="twitter link"> <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"> 
                                    <path d="M22.162 5.656a8.384 8.384 0 0 1-2.402.658A4.196 4.196 0 0 0 21.6 4c-.82.488-1.719.83-2.656 1.015a4.182 4.182 0 0 0-7.126 3.814 11.874 11.874 0 0 1-8.62-4.37 4.168 4.168 0 0 0-.566 2.103c0 1.45.738 2.731 1.86 3.481a4.168 4.168 0 0 1-1.894-.523v.052a4.185 4.185 0 0 0 3.355 4.101 4.21 4.21 0 0 1-1.89.072A4.185 4.185 0 0 0 7.97 16.65a8.394 8.394 0 0 1-6.191 1.732 11.83 11.83 0 0 0 6.41 1.88c7.693 0 11.9-6.373 11.9-11.9 0-.18-.005-.362-.013-.54a8.496 8.496 0 0 0 2.087-2.165z"/> 
                                </svg></a> 
                            <a href="#" class="hover:text-blue-400" aria-label="instagram link"> <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"> 
                                    <path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.883 4.883 0 0 1-1.153 1.772 4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.428.465-1.066.047-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.218-2.428-.465a4.89 4.89 0 0 1-1.772-1.153 4.904 4.904 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm6.5-.25a1.25 1.25 0 0 0-2.5 0 1.25 1.25 0 0 0 2.5 0zM12 9a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/> 
                                </svg></a> 
                            <a href="#" class="hover:text-blue-400" aria-label="linkedin link"> <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"> 
                                    <path d="M6.94 5a2 2 0 1 1-4-.002 2 2 0 0 1 4 .002zM7 8.48H3V21h4V8.48zm6.32 0H9.34V21h3.94v-6.57c0-3.66 4.77-4 4.77 0V21H22v-7.93c0-6.17-7.06-5.94-8.72-2.91l.04-1.68z"/> 
                                </svg></a> 
                            <a href="#" class="hover:text-blue-400" aria-label="youtube link"> <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"> 
                                    <path d="M21.543 6.498C22 8.28 22 12 22 12s0 3.72-.457 5.502c-.254.985-.997 1.76-1.938 2.022C17.896 20 12 20 12 20s-5.893 0-7.605-.476c-.945-.266-1.687-1.04-1.938-2.022C2 15.72 2 12 2 12s0-3.72.457-5.502c.254-.985.997-1.76 1.938-2.022C6.107 4 12 4 12 4s5.896 0 7.605.476c.945.266 1.687 1.04 1.938 2.022zM10 15.5l6-3.5-6-3.5v7z"/> 
                                </svg></a> 
                        </div>                         
                    </div>                     
                </div>                 
                <div class="py-4 text-sm"> 
                    <hr class="border-gray-400 mb-4 opacity-25"> 
                    <div class="flex flex-wrap -mx-4  items-center"> 
                        <div class="px-4 py-2 w-full md:flex-1"> 
                            <p>&copy; 2002 - 2021 | All Rights Reserved - Company Name</p> 
                        </div>                         
                        <div class="px-4 py-2 w-full sm:w-auto"> 
                            <a href="#" class="hover:text-gray-400">Privacy Policy</a> |                      
                            <a href="#" class="hover:text-gray-400">Terms of Use</a> 
                        </div>                         
                    </div>                     
                </div>                 
            </div>             
        </footer> -->
    </body>

    </html>
<?php } ?>