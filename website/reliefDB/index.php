<?include_once("global.php");?>
<?
if ($logged==1){ 
    ?>
    <script type="text/javascript">
            window.location = "./dashboard.php";
        </script>
    <?
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="HU - Library just got a major upgrade. Built by Anomoz.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>ReliefDB</title>

    <!-- Favicon -->
    <link rel="icon" href="./img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="styleHome.css">

</head>

<body>
    

 
    <!-- ***** Top Search Area End ***** -->
    <!-- ***** Header Area End ***** -->

    <!-- ***** Welcome Area Start ***** -->
    <section class="welcome-area">
        <div class="welcome-slides owl-carousel">

            <!-- Single Welcome Slide -->
            <div class="single-welcome-slide">
                <!-- Background Curve -->
                <div class="background-curve">
                    <img src="./img/core-img/curve-1.png" alt="">
                </div>

                <!-- Welcome Content -->
                <div class="welcome-content h-100" style="height: 80% !important;">
                    <div class="container h-100" style="height: 90% !important;">
                        <div class="row h-100 align-items-center">
                            <!-- Welcome Text -->
                            <div class="col-12 col-md-6">
                                <div class="welcome-text">
                                    <h2 data-animation="fadeInUp" >ReliefDB<br><span>NGO Portal</span></h2>
                                    <a href="./login.php" class="btn uza-btn btn-2" data-animation="fadeInUp" data-delay="700ms">Login</a>
                                     <a href="./signup.php" class="btn uza-btn btn-2" data-animation="fadeInUp" data-delay="700ms">Signup</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

           

        </div>
    </section>
    <!-- ***** Welcome Area End ***** -->

    <!-- ***** Newsletter Area End ***** -->

    <!-- ***** Footer Area Start ***** -->
    <footer class="footer-area section-padding-80-0">
        <div class="container">
           
 <div class="row" style="margin-bottom: 30px;">
                
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Created by  <a href="https://anomoz.com" target="_blank"> Anomoz</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </div>

        </div>
    </footer>
    <!-- ***** Footer Area End ***** -->

    <!-- ******* All JS Files ******* -->
    <!-- jQuery js -->
    <script src="js/jquery.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- All js -->
    <script src="js/uza.bundle.js"></script>
    <!-- Active js -->
    <script src="js/default-assets/active.js"></script>

</body>

</html>