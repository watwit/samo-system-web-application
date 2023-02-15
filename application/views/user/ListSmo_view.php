<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Charm&display=swap" rel="stylesheet">
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
    <title>ทำเนียบ</title>
</head>

<body>



<div class="row m-5"></div>
    <div class=" col-12 col-md-12">
    <div class="row p-3"></div>
        <h6>
            <p class="font-weight-bold text-center" style="font-family: 'Charm', cursive;font-size: 30px;"><img src="<?php echo base_url('img');?>/samo.png" width="60" height="60"> <u>ทำเนียบสโมสรนิสิตคณะวิศวกรรมศาสตร์ ศรีราชา</u></p>
        </h6>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="container-fluid">
                        <div class="row">
                            <?php
                            $i = 1;
                            $color = '';
                            foreach ($query as $row) {
                                $name = $row->name;
                                $picture = $row->picture;
                                $major = $row->major_name;
                                // $sex = $row->sex;
                                $rank = $row->rank;
                                switch ($rank) {
                                    case '10':
                                        $rankshow = 'นายก';
                                        break;
                                    case '11':
                                        $rankshow = 'รองนายก';
                                        break;
                                    case '12':
                                        $rankshow = 'เลขา';
                                        break;
                                    case '13':
                                        $rankshow = 'เหรัญญิก';
                                        break;
                                    case '14':
                                        $rankshow = 'สันทนาการ';
                                        break;
                                    case '15':
                                        $rankshow = 'บุคคล';
                                        break;
                                    case '16':
                                        $rankshow = 'สถานที่';
                                        break;
                                    case '17':
                                        $rankshow = 'จัดซื้อ';
                                        break;
                                    case '18':
                                        $rankshow = 'ระเบียบ';
                                        break;
                                    case '19':
                                        $rankshow = 'พยาบาล';
                                        break;
                                    case '20':
                                        $rankshow = 'สวัสดิการ';
                                        break;
                                    case '21':
                                        $rankshow = 'วิชาการ';
                                        break;
                                    case '22':
                                        $rankshow = 'สรุปโครงการ';
                                        break;
                                    case '23':
                                        $rankshow = 'ประชาสัมพันธ์';
                                        break;
                                    default:
                                        $rankshow = $rank;
                                        break;
                                    }
                            ?>
                                <section class="col-12 col-sm-6 col-md-4 p-3">
                                    <div class="card h-100" style="width: 300px;margin: auto;">
                                        <!-- <a class="warpper-card-img"> -->
                                            <img class="card-img-top" src=" <?php echo base_url('img'); ?>/<?php echo $picture; ?>" width="200px" >

                                        <!-- </a> -->
                                        <div class="card-body ">
                                            <h6 class="card-title" style='font-size:20px'>ชื่อ:  <?php echo $name ?></h6>
                                            <h6 class="card-title" style='font-size:20px'>ตำแหน่ง: <?php echo $rankshow ?></h6>
                                            <h6 class="card-title" style='font-size:20px'>สาขา: <?php echo $major ?></h6>
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