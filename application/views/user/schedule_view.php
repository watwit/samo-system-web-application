
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>กำหนดการกิจกรรม</title>
    <script>
    $(function() {
      $('#example').DataTable({
        "paging": false,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": true
      });
    });
    </script>
</head>

<body>
    <div class="containner">
        <div class="p-5 col-12 "></div>
            <div class="p-5 col-12 col-md-9 text-center mx-auto">
            <?php
                if(!empty($head)){
                foreach ($head as $row) {
                                $date = $row->date;
                                $activity_name = $row->activity_name; ?>
                <p class="font-weight-bold " style="font-size: 25px;">กำหนดการ : <?php echo $activity_name; ?></p>
                <p class="font-weight-bold " style="font-size: 25px;"><?php echo $date; ?></p><?php }}else{?>
                    <p class="font-weight-bold " style="font-size: 25px;">กำหนดการ</p>
                    <?php }?>
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered text-center">
                        <thead style="background: #61C0BF">
                            <tr>
                                <th scope="col">เวลา</th>
                                <th scope="col">กิจกรรม</th>
                                <th scope="col">หมายเหตุ</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i = 1;
                            foreach ($query as $row) {
                                $schedule_id = $row->schedule_id;
                                $activity_id = $row->activity_id;
                                $time = $row->time;
                                $schedule_name = $row->schedule_name;
                                $note = $row->note; ?> 
                                        <tr>
                                            <td><?php echo $time; ?></td>
                                            <td><?php echo $schedule_name; ?></td>
                                            <td><?php echo $note; ?></td>
                                        </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <footer class="semi-footer p-5 text-center text-md-left">
    <div class="row">
        <div class="col-md-6">
            <a class="navbar-brand" href="#">
                <img src="<?php echo base_url('img');?>/samo.png" width="35" height="35" class="d-inline-block align-top" alt="">
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
            <div ><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d971.4259579847143!2d100.92028242919304!3d13.117939299422499!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3102b9dbb703b1a1%3A0xeccebb34440cd95c!2z4Lit4Liy4LiE4Liy4LijIDkg4Lio4Li54LiZ4Lii4LmM4LiB4Li04LiI4LiB4Lij4Lij4Lih!5e0!3m2!1sth!2sth!4v1582302178935!5m2!1sth!2sth" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>
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