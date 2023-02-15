<!DOCTYPE html>
<html lang="en">

<head>
    <title>เพลง</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .img-fluid {
            FONT-WEIGHT: 800;
            max-width: 80%;
            height: auto;
        }

        @media (max-width: 768px) {
            .img-fluid {
                FONT-WEIGHT: 800;
                max-width: 100%;
                height: 75%;
            }
        }
    </style>
</head>

<body class="bg-light">

    <div class="container mx-auto m-5">
        <div class="row m-5 p-3"></div>
        <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner mx-auto img-fluid">
                <div class="carousel-item active">
                    <a class="navbar-brand px-5"> <img src="<?php echo base_url('img'); ?>/สามัคคี.png" alt="ss1"></a>
                </div>
                <div class="carousel-item">
                    <a class="navbar-brand px-5"> <img src="<?php echo base_url('img'); ?>/แรงเลือดหมู.png" alt="ss2"></a>
                </div>
                <div class="carousel-item">
                    <a class="navbar-brand px-5"> <img src="<?php echo base_url('img'); ?>/วิศวดงตาล.png" alt="ss3"></a>
                </div>
                <div class="carousel-item">
                    <a class="navbar-brand px-5"> <img src="<?php echo base_url('img'); ?>/เลือดวิษณุ.png" alt="ss4"></a>
                </div>
                <div class="carousel-item">
                    <a class="navbar-brand px-5"> <img src="<?php echo base_url('img'); ?>/Boom.png" alt="ss5"></a>
                </div>
                <div class="carousel-item">
                    <a class="navbar-brand px-5"> <img src="<?php echo base_url('img'); ?>/ธงชัย.png" alt="ss6"></a>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="fas fa-chevron-left fa-4x" style="color: #990000"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="fas fa-chevron-right fa-4x" style="color: #990000"></span>
            </a>
        </div>
    </div>





    <footer class="semi-footer p-5 text-center text-md-left">
        <div class="row">
            <div class="col-md-6">
                <a class="navbar-brand" href="#">
                    <img src="<?php echo base_url('img'); ?>/samo.png" width="35" height="35" class="d-inline-block align-top" alt="">
                    สโมสรนิสิตคณะวิศวกรรมศาสตร์ ศรีราชา
                </a>
                <p>
                    <i class="fab fa-facebook"></i> สโมสรนิสิตคณะวิศวกรรมศาสตร์ศรีราชา มหาวิทยาลัยเกษตรศาสตร์ วิทยาเขตศรีราชา <br>
                    <i class="fab fa-instagram"></i> SMOENG <br>

                </p>
                <a href="https://www.facebook.com/smoeng.kusrc/" target="_blank">
                    <i class="fab fa-facebook-square fa-2x"></i>
                </a>
                <a href="https://www.youtube.com/channel/UClERRmTohro9pXrQr2mMVyg" target="_blank">
                    <i class="fab fa-youtube-square fa-2x"></i>
                </a>
            </div>
            <div class="col-md-6">
                <h4>แผนที่</h4>
                <div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d971.4259579847143!2d100.92028242919304!3d13.117939299422499!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3102b9dbb703b1a1%3A0xeccebb34440cd95c!2z4Lit4Liy4LiE4Liy4LijIDkg4Lio4Li54LiZ4Lii4LmM4LiB4Li04LiI4LiB4Lij4Lij4Lih!5e0!3m2!1sth!2sth!4v1582302178935!5m2!1sth!2sth" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>
            </div>
        </div>
    </footer>
    <!-- <footer class="footer">
        <span> COPYRIGHT © 2020
            <a href="https://www.facebook.com/smoeng.kusrc/" target="_blank">สโมสรนิสิตคณะวิศวกรรมศาสตร์ศรีราชา มหาวิทยาลัยเกษตรศาสตร์ วิทยาเขตศรีราชา</a>
            ALL Right Reserved
        </span>
    </footer> -->
</body>

</html>