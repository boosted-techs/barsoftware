<?php
include_once "headers/index.php";
?>

<body>
<div id="ebazar-layout" class="theme-blue">

    <!-- main body area -->
    <div class="main p-2 py-3 p-xl-5 ">

        <!-- Body: Body -->
        <div class="body d-flex p-0 p-xl-5">
            <div class="container-xxl">

                <div class="row g-0">
                    <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                        <div style="max-width: 25rem;">
                            <div class="text-center mb-5">
                                <i class="bi bi-bag-check-fill  text-primary" style="font-size: 90px;"></i>
                            </div>
                            <div class="mb-5">
                                <h2 class="color-900 text-center">A few clicks is all it takes.</h2>
                            </div>
                            <!-- Image block -->
                            <div class="">
                                <img src="/assets/images/login-img.svg" alt="login-img">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                        <div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 32rem;">
                            <!-- Form -->
                            <?php if(isset($_SESSION['error_message'])) :?>
                            <div class="alert alert-danger">
                                <?=$_SESSION['error_message']?>
                            </div>
                            <?php endif;?>
                            <form class="row g-1 p-3 p-md-4" action="/login" method="post">
                                <div class="col-12 text-center mb-5">
                                    <h1>Sign in</h1>

                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control form-control-lg" placeholder="name@example.com">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <input type="password" name="password" class="form-control form-control-lg" placeholder="***************">
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <span>Don't have an account yet? Ask administrator</a></span>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <button class="btn btn-lg btn-primary form-control btn-block btn-light lift text-uppercase" type="submit">SIGN IN</button>
                                </div>
                            </form>
                            <!-- End Form -->

                        </div>
                    </div>
                </div> <!-- End Row -->

            </div>
        </div>

    </div>

</div>


<?php
include_once "headers/footer.php";
?>
