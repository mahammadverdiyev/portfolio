<?php
include("../header.php");
$message = "";
$email = "";
if (isset($_SESSION['user']) && $_SESSION['permission'] == 'admin') {
    header("Location: dashboard.php");
}


if (isset($_GET['code'])) {
    if (isset($_GET['username'])) {
        $username = $_GET['username'];
    }
    $code = $_GET['code'];

    switch ($code) {
        case 1:
            $message = "403 Forbidden! Directly access is denied!";
            break;
        case 2:
        case 3:
            $message = "Email or password is wrong!";
            break;
    }

}


?>

<section class="vh-100 bg-image"
         style="background-color: rgb(52,58,64); position: center; background-size: cover;height: 150vh;width: 100%">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Admin Login</h2>

                            <form action="doLogin.php" method="post">

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="inputUsername">Your Username</label>
                                    <input name="username" value="<?= $email ?>" type="text" id="inputUsername"
                                           class="form-control form-control-lg" required/>
                                </div>


                                <div class="form-outline mb-4">
                                    <label class="form-label" for="inputPassword">Password</label>
                                    <input name="password" type="password" id="inputPassword"
                                           class="form-control form-control-lg" required/>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body ">
                                        Login
                                    </button>
                                </div>

                                <p style="color: red"><?= $message ?></p>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
include("../bootstrap_js.php")
?>
