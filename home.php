<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Enhanced DTS - SDOIN</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <style>
            .stepper .line {
                width: 2px;
                background-color: grey !important;
            }
            .stepper .lead {
                font-size: 1.1rem;
            }
        </style>
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="?home">~sdoin.edts</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="?home">Home</a></li>
                        <?php
                        if(isset($_SESSION['user']))
                        {
                            echo '<li class="nav-item"><a class="nav-link" href="./dashboard">Dashboard</a></li>';
                        }
                        else
                        {
                            echo '<li class="nav-item"><a class="nav-link" href="?login">Login</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center my-5">
                            <img src="assets/images/sdoin-logo-small.png" width="25%" alt="SDOIN Logo">
                            <h1 class="display-5 fw-bolder text-white mb-2"><a href="?home" class="text-decoration-none text-white">Enhanced DTS</a></h1>
                            <p class="lead text-white-50 mb-4">Enter the tracking no. and click on track to see its current status.</p>
                            <form action="" method="GWT">
                                <div class="box">     
                                    <input class="form-control form-control-lg" type="text" name="tracking" class="text-white font-weight-bold" style="background-color:rgba(0,0,0,0) !important;color: white; border:none;text-align:center;" placeholder="Type here." autofocus required>
                                    <br>
                                </div>
                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                    <button type="submit" class="btn btn-outline-light btn-lg px-4"><i class="bi bi-search"></i>&nbsp;Track</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Features section-->
        <section class="py-5 border-bottom" id="features">
            <div class="container px-5 my-5">
                <div class="row gx-5">
                    <?php
                        if(isset($_GET['tracking']))
                        {
                            include("includes/tracking.php");
                        }
                        else
                        {
                            include("includes/features.php");
                        }
                    ?>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container px-5"><p class="m-0 text-center text-white">Copyright &copy; Louis Velasco</a>. Made with <a href="?inspiration" class="text-decoration-none">❤</a> <script>document.write(new Date().getFullYear())</script></p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
