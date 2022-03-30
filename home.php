<?php require("config.php"); ?>
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
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="#!">~sdoin.edts</a>
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
                            <h1 class="display-5 fw-bolder text-white mb-2">Enhanced DTS</h1>
                            <p class="lead text-white-50 mb-4">Enter the tracking no. and click on track to see its current status.</p>
                            <form action="#" method="post">
                                <div class="box">     
                                    <input class="form-control form-control-lg" type="text" name="trackingno" class="text-white font-weight-bold" style="background-color:rgba(0,0,0,0) !important;color: white; border:none;text-align:center;" placeholder="Type here." autofocus required>
                                    <br>
                                </div>
                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                    <button type="submit" class="btn btn-outline-light btn-lg px-4" name="track"><i class="bi bi-search"></i>&nbsp;Track</button>
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
                    <div class="col-lg-3 mb-5 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-collection"></i></div>
                        <h2 class="h4 fw-bolder">Organization</h2>
                        <p>The eDTS Project aims to achieve better organization of documents by visualizing your current physical arrayed documents in a user-friendly, digital approach.</p>
                    </div>
                    <div class="col-lg-3 mb-5 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-cursor"></i></div>
                        <h2 class="h4 fw-bolder">Optimization</h2>
                        <p>This project also aims to optimize the tracking process, enabling bulk releasing and receiving for units with a lot of documents to work on for improved efficiency.</p>
                    </div>
                    <div class="col-lg-3 mb-5 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-upc-scan"></i></div>
                        <h2 class="h4 fw-bolder">Scanning</h2>
                        <p>An added feature of the eDTS is the ability for users to scan the documents to automatically receive it without having to type the tracking no. (Typing is still supported)</p>
                    </div>
                    <div class="col-lg-3">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-cloud-upload"></i></div>
                        <h2 class="h4 fw-bolder">Cloud Upload</h2>
                        <p>Some documents may be processed online without having to print a physical copy. The list of document types will be posted soon.</p>
                    </div>
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
