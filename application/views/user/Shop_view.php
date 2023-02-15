<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&display=swap" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    <style>
        .warpper-card-img {
            position: relative;
            overflow: hidden;
            padding-top: 56.25%;
        }

        .warpper-card-img img {
            position: absolute;
            top: 0;
            transition: 1s;
        }

        .warpper-card-img img:hover {
            transform: scale(1.2)
        }

    </style>
    <title>ร้านค้า</title>
</head>

<body>
    <div class="container-fluid">
        <div class="pt-5 "></div>
        <div class="card border-dark row mt-5 ml-5" style="max-width: 10rem;">
            <?php
            foreach ($sta as $row) {
                $shopstatus = $row->shopstatus; ?>
            <?php } ?>
            <li class="list-group-item text-center">
                <ion-icon size="small" name="clock"></ion-icon>ร้านค้า : <?php echo $shopstatus; ?>
            </li>
            
        </div>
        <!-- <h5>
            <p class="font-weight-bold text-center" style="font-family: 'Trade Winds', cursive; font-size: 45px;"> I  <i class="fas fa-heartbeat" style="color: #ff0000"></i>  Shopping </p>
        </h5> -->

        <h5>
            <p class="font-weight-bold text-center" style="font-family: 'Caveat', cursive; font-size: 45px;"> <i class="fas fa-shopping-cart" style="color: #990000"></i>  Shopping </p>
        </h5>
    </div>
    <div class="pb-5 col-12 col-md-12">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="container-fluid">
                        <div class="row">
                            <?php
                            $i = 1;
                            $color = '';
                            foreach ($query as $row) {
                                $shop_id = $row->shop_id;
                                $picture = $row->pic;
                                $name = $row->name;
                                $price = $row->price;
                                $detail = $row->detail;
                                $status = $row->status;
                                if ($status == 'มีสินค้า') {
                                    $color = 'badge-warning';
                                } else {
                                    $color = 'badge-danger';
                                }
                            ?>
                                <section class="col-12 col-sm-6 col-md-3 p-3">
                                    <div class="card h-100">
                                        <a class="warpper-card-img">
                                            <img class="card-img-top" src=" <?php echo base_url('img'); ?>/<?php echo $picture; ?>">

                                        </a>
                                        <div class="card-body ">
                                            <h5 class="card-title" style='font-size:35px'><?php echo $name ?></h5>
                                            <p class="card-text"><?php echo $detail ?></p>
                                        </div>
                                        <div class="row input-group form-group">
                                            <p class="row-8 p-3 badge ml-4" style='font-size:17px'>ราคา : <?php echo $price; ?></p>
                                            <p class="row-4 p-3 badge <?php echo $color; ?> text-dark ml-auto" style='font-size:17px'><?php echo $status; ?></p>
                                        </div>
                                    </div>
                                </section>
                            <?php } ?>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
    </div>
</body>
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
</html>