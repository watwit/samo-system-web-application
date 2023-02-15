<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>กิจกรรม</title>
</head>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "bInfo": false
        });
        $('.showtable').click(function() {
            var award_id = $(this).attr('data-award_id');
            $.ajax({
                url: '<?php echo site_url('activity_user/showTableModal') ?>',
                method: "POST",
                data: {
                    award_id: award_id
                },
                success: function(data) {
                    $('#table_result').html(data);
                    $('#showmodal').modal('show');
                }
            });
        });
        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 2,
                    nav: false
                },
                1000: {
                    items: 3,
                    nav: true,
                }
            }
        })
    });
</script>
</head>

<body>
    <div class="row m-5"></div>
    <?php
    $student_id = '';
    $student_name = '';
    $major = '';

    foreach ($dd as $row) {
        $student_id = $row->student_id;
        $student_name = $row->student_name;
        $major = $row->major_code;
    }
    ?>
    <div class="row m-1">
        <div class="card border-dark row m-3" style="max-width: 18rem;">
            <li class="list-group-item text-center">
                <ion-icon size="small" name="contact"></ion-icon>ชื่อ: <?= $student_name; ?>
            </li>
        </div>
        <div class="card border-dark row m-3" style="max-width: 18rem;">
            <li class="list-group-item text-center">
                <ion-icon size="small" name="contact"></ion-icon>รหัส: <?= $student_id; ?>
            </li>
        </div>
        <div class="card border-dark row m-3" style="max-width: 18rem;">
            <li class="list-group-item text-center">
                <ion-icon size="small" name="briefcase"></ion-icon>สาขา: <?= $major; ?>
            </li>
        </div>
    </div>
    <div class="container ">
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel owl-theme">
                    <?php
                    $i = 0;
                    $j = 0;
                    while ($i < count($card1)) {
                        $award_id = $card1[$i]->award_id;
                        $award_name = $card1[$i]->award_name;
                        $picture = $card1[$i]->picture;
                        $award_time = $card1[$i]->award_time;
                        $time_all_activity = $card1[$i]->time_all_activity;
                        if(!empty($card2)){
                            if($j<count($card2)){
                                if ($card1[$i]->award_id == $card2[$j]->award_id  ) {
                                    $time_in = $card2[$j]->time_in;
                                    $j++;
                                } else {
                                    $time_in = 0;
                                }
                            }
                            else {
                                $time_in = 0;
                            }
                        }
                        else{
                        $time_in = 0;
                        }
                        $result = (((int) $time_all_activity) * ((int) $award_time) / 100);
                        $i++;
                    ?>
                        <section class="col-12 p-2">
                            <div class="card h-100 card-content">
                                <a href="#" class="warpper-card-img">
                                    <img class="card-img-top" src="<?php echo base_url('img/') . $picture; ?>">
                                </a>
                                <div class="card-body ">
                                    <h5 class="card-title"><?php echo $award_name ?></h5>
                                    <!-- <p class="card-text"><?php echo $result ?></p> -->
                                </div>
                                <div class="p-3">
                                    <button data-award_id='<?php echo $award_id; ?>' class="btn  showtable <?php echo $result <= (int) ($time_in) ? 'btn-warning' : 'btn-danger' ?>"><i class="fas fa-search"></i> <?php echo $result <= (int) ($time_in) ? 'ได้รับเเล้ว' : 'ยังไม่ได้รับ' ?></button>
                                </div>
                            </div>
                        </section>
                    <?php }?>
                    

                    <!-- no activity -->
                    <?php 
                    foreach($card3 as $row){ 
                        $award_id = $row->award_id;
                        $award_name = $row->award_name;
                        $picture = $row->picture;?>
                        <section class="col-12 p-2">
                            <div class="card h-100 card-content">
                                <a href="#" class="warpper-card-img">
                                    <img class="card-img-top" src="<?php echo base_url('img/') . $picture; ?>">
                                </a>
                                <div class="card-body ">
                                    <h5 class="card-title"><?php echo $award_name ?></h5>
                                    <!-- <p class="card-text"><?php echo $result ?></p> -->
                                </div>
                                <div class="p-3">
                                <button data-award_id='<?php echo $award_id; ?>' class="btn btn-danger showtable"><i class="fas fa-search"></i> ยังไม่ได้รับ</button>
                                </div>
                            </div>
                        </section>
                    <?php }?>
                    <!-- /no activity -->
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <div class="row">
            <p align="center" class="mx-auto"><span style='font-size:30px'>กิจกรรมทั้งหมดของฉัน</span></p>
            <br>
            <div class="table-responsive">
                <div class="col-10  mx-auto">
                    <table id="example" class="table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th bgcolor="#A4EADA" scope="col">ลำดับ</th>
                                <th bgcolor="#A4EADA" scope="col">กำหนดการ</th>
                                <th bgcolor="#A4EADA" scope="col">ชื่อกิจกรรม</th>
                                <th bgcolor="#A4EADA" scope="col">จำนวนชั่วโมงที่ได้รับ</th>
                                <th bgcolor="#A4EADA" scope="col">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($query as $row) {
                                $activity_id = $row->activity_id;
                                $date = $row->date;
                                $activity_name = $row->activity_name;
                                $time = $row->amont_of_time;
                                $checkactivity =  $row->checkactivity;
                            ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo $activity_name; ?></td>
                                    <td><?php echo $time; ?></td>
                                    <td><?php echo $checkactivity == 'YES' ? '/' : 'X'; ?> </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="showmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">กิจกรรมที่นิสิตต้องทำ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                            <div id="table_result"></div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

</HTML>