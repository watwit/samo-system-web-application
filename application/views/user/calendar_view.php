<!DOCTYPE html>
<html>

<head>
    <title>กิจกรรม</title>
</head>

<body>

    <br>
    &nbsp;
    <div class="row m-5"></div>
    <?php if ($this->session->flashdata('check')) { ?>
        <div class="alert alert-warning col-5  mx-auto text-center">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <?php echo $this->session->flashdata('check') ?>
        </div>
    <?php } ?>
    <?php
    $uri = $_SERVER['REQUEST_URI'];
    $array = explode('/', $uri);
    $key = array_search("se", $array);
    $name = $array[$key + 1];
    ?>
    <center>
        <?php if ($name != 'Activity_user') { ?>
            <form action="<?php echo site_url('calendar/checkLogin') ?>" method="POST">
                <input style="height:38px;" type="text" name="list_id" id="idStudent" placeholder=" กรอกรหัสนิสิตเพื่อยืนยันตัวตน   " maxlength="10" size="30" width="50" required="" autofocus=""onKeyUp="if(isNaN(this.value)&& this.value.length>0){ alert('กรุณากรอกตัวเลข'); this.value='';}" autocomplete="off">
                <button class="btn btn-outline-Primary login_btn" id="btnid" type="submit" name="submit">ยืนยัน</button>

            </form>
        <?php } ?>
    </center>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php
                $dateComponents = getdate();
                if (isset($_GET['month']) && isset($_GET['year'])) {
                    $month = $_GET['month'];
                    $year = $_GET['year'];
                } else {
                    $month = $dateComponents['mon'];
                    $year = $dateComponents['year'];
                }
                // Create array containing abbreviations of days of week.
                $daysOfWeek = array('วันอาทิตย์', 'วันจันทร์', 'วันอังคาร', 'วันพุธ', 'วันพฤหัสบดี', 'วันศุกร์', 'วันเสาร์');

                // What is the first day of the month in question?
                $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

                // How many days does this month contain?
                $numberDays = date('t', $firstDayOfMonth);

                // Retrieve some information about the first day of the
                // month in question.
                $dateComponents = getdate($firstDayOfMonth);

                // What is the name of the month in question?
                $monthName = $dateComponents['month'];

                if ($monthName == 'January') {
                    $monthName = 'มกราคม';
                } else if ($monthName == 'February') {
                    $monthName = 'กุมภาพันธ์';
                } else if ($monthName == 'March') {
                    $monthName = 'มีนาคม';
                } else if ($monthName == 'April') {
                    $monthName = 'เมษายน';
                } else if ($monthName == 'May') {
                    $monthName = 'พฤษภาคม';
                } else if ($monthName == 'June') {
                    $monthName = 'มิถุนายน';
                } else if ($monthName == 'July') {
                    $monthName = 'กรกฎาคม';
                } else if ($monthName == 'August') {
                    $monthName = 'สิงหาคม';
                } else if ($monthName == 'September') {
                    $monthName = 'กันยายน';
                } else if ($monthName == 'October') {
                    $monthName = 'ตุลาคม';
                } else if ($monthName == 'November') {
                    $monthName = 'พฤศจิกายน';
                } else if ($monthName == 'December') {
                    $monthName = 'ธันวาคม';
                }
                // What is the index value (0-6) of the first day of the
                // month in question.
                $dayOfWeek = $dateComponents['wday'];

                // Create the table tag opener and day headers

                $datetoday = date('Y-m-d');
                $year += 543;
                echo "<center>";
                echo "<div class='dropdown'>";
                echo "<button class='btn btn-outline-Info dropdown-toggle' type='button' data-toggle='dropdown'>เลือกเดือนที่ต้องกการ";
                echo "</button>";
                echo "<div class='dropdown-menu'>";
                echo "<a class='dropdown-item' href='?month=" . date('m') . "&year=" . date('Y') . "'>ปัจจุบัน</a></li>";
                echo "<a class='dropdown-item' href='?month=" . date('01') . "&year=" . date('Y') . "'>มกราคม</a></li>";
                echo "<a class='dropdown-item' href='?month=" . date('02') . "&year=" . date('Y') . "'>กุมภาพันธ์</a></li>";
                echo "<a class='dropdown-item' href='?month=" . date('03') . "&year=" . date('Y') . "'>มีนาคม</a></li>";
                echo "<a class='dropdown-item' href='?month=" . date('04') . "&year=" . date('Y') . "'>เมษายน</a></li>";
                echo "<a class='dropdown-item' href='?month=" . date('05') . "&year=" . date('Y') . "'>พฤษภาคม</a></li>";
                echo "<a class='dropdown-item' href='?month=" . date('06') . "&year=" . date('Y') . "'>มิถุนายน</a></li>";
                echo "<a class='dropdown-item' href='?month=" . date('07') . "&year=" . date('Y') . "'>กรกฎาคม</a></li>";
                echo "<a class='dropdown-item' href='?month=" . date('08') . "&year=" . date('Y') . "'>สิงหาคม</a></li>";
                echo "<a class='dropdown-item' href='?month=" . date('09') . "&year=" . date('Y') . "'>กันยายน</a></li>";
                echo "<a class='dropdown-item' href='?month=" . date('10') . "&year=" . date('Y') . "'>ตุลาคม</a></li>";
                echo "<a class='dropdown-item' href='?month=" . date('11') . "&year=" . date('Y') . "'>พฤศจิกายน</a></li>";
                echo "<a class='dropdown-item' href='?month=" . date('12') . "&year=" . date('Y') . "'>ธันวาคม</a></li>";
                echo "</div>";
                echo "</div>";
                echo "<br>";
                if ($month + 1 > 12) {
                    echo "<div class='carousel slide' data-ride='carousel'>
                            <!-- The slideshow -->
                            <div class='carousel-inner month'>
                                <div class='carousel-item active'>
                                    <a class='navbar-brand  text-white'>" . $monthName . "<br>" . $year . "</a>
                                </div>
                            </div>
                    
                                <!-- Left and right controls -->
                                <a class='carousel-control-prev' href='?month=" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . "&year=" . (int) ($year - 543) . "' data-slide='prev'>
                                 <span class='fas fa-chevron-left'> </span>  
                                </a>
                                <a class='carousel-control-next' href='?month=" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . "&year=" . ((int) ($year - 543) + 1) . "' data-slide='next'>
                                <span class='fas fa-chevron-right'> </span>  
                                </a>
                            </div>";
                    echo "</center>";

                    //create table
                    echo "<table   class='table table-bordered'>";
                    // echo "<br>";
                } else if ($month - 1 < 1) {
                    echo "<div class='carousel slide' data-ride='carousel'>
                            <!-- The slideshow -->
                            <div class='carousel-inner month'>
                                <div class='carousel-item active'>
                                    <a class='navbar-brand  text-white'>" . $monthName . "<br>" . $year . "</a>
                                </div>
                            </div>
                    
                                <!-- Left and right controls -->
                                <a class='carousel-control-prev' href='?month=" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . "&year=" . ((int) ($year - 543) - 1) . "' data-slide='prev'>
                                 <span class='fas fa-chevron-left'> </span>  
                                </a>
                                <a class='carousel-control-next' href='?month=" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . "&year=" . (int) ($year - 543) . "' data-slide='next'>
                                <span class='fas fa-chevron-right'> </span>  
                                </a>
                            </div>";
                    echo "</center>";

                    //create table
                    echo "<table   class='table table-bordered'>";
                    // echo "<br>";
                } else {
                    echo "<div class='carousel slide' data-ride='carousel'>
                            <!-- The slideshow -->
                            <div class='carousel-inner month'>
                                <div class='carousel-item active'>
                                    <a class='navbar-brand  text-white'>" . $monthName . "<br>" . $year . "</a>
                                </div>
                            </div>
                    
                                <!-- Left and right controls -->
                                <a class='carousel-control-prev' href='?month=" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . "&year=" . (int) ($year - 543) . "' data-slide='prev'>
                                 <span class='fas fa-chevron-left'> </span>  
                                </a>
                                <a class='carousel-control-next' href='?month=" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . "&year=" . (int) ($year - 543) . "' data-slide='next'>
                                <span class='fas fa-chevron-right'> </span>  
                                </a>
                            </div>";
                    echo "</center>";

                    //create table
                    echo "<table   class='table table-bordered'>";
                    // echo "<br>";
                }

                echo "<tr >";

                // Create the calendar headers
                $year -= 543;
                foreach ($daysOfWeek as $day) {
                    echo "<th   class='header bg-Info text-white'>$day</th>";
                }

                // Create the rest of the calendar

                // Initiate the day counter, starting with the 1st.

                $currentDay = 1;

                echo "</tr><tr  >";

                // The variable $dayOfWeek is used to
                // ensure that the calendar
                // display consists of exactly 7 columns.

                if ($dayOfWeek > 0) {
                    for ($k = 0; $k < $dayOfWeek; $k++) {
                        echo "<td  class='empty' bgcolor='#FFFFFF'></td>";
                    }
                }


                $month = str_pad($month, 2, "0", STR_PAD_LEFT);
                //  require_once 'connectdb.php';
                //  $activity_id = 0;

                while ($currentDay <= $numberDays) {

                    // Seventh column (Saturday) reached. Start a new row.

                    if ($dayOfWeek == 7) {

                        $dayOfWeek = 0;
                        echo "</tr><tr >";
                    }

                    $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
                    $date = "$year-$month-$currentDayRel";
                    $dayname = strtolower(date('l', strtotime($date)));
                    $eventNum = 0;
                    $today = $date == date('Y-m-d') ? "today" : "";
                    foreach ($query as $row) {
                        $activity_id = $row->activity_id;
                        $activity_date = $row->date;
                        $activity_name = $row->activity_name;

                        if ($date == $activity_date) {
                            echo "<td class='$today' bgcolor='#FFFFFF'><h4>$currentDay</h4>" . " <a href='scheduleuser/show/" . $activity_id . "' class='btn btn-outline-warning btn-xs'>" . $activity_name . " </a>";
                            break;
                        }
                    }
                    if ($date != $activity_date) {
                        echo "<td class='$today' bgcolor='#FFFFFF'><h4>$currentDay</h4>";
                    }

                    //}  


                    //elseif(in_array($date, $bookings)){
                    //      $calendar.="<td class='$today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>Already Booked</button>";
                    //}




                    echo "</td>";
                    // Increment counters

                    $currentDay++;
                    $dayOfWeek++;
                }



                // Complete the row of the last week in month, if necessary

                if ($dayOfWeek != 7) {

                    $remainingDays = 7 - $dayOfWeek;
                    for ($l = 0; $l < $remainingDays; $l++) {
                        echo "<td class='empty'></td>";
                    }
                }

                echo "</tr>";

                echo "</table>";
                echo '<div class="row"></div>
                            <div class="row"></div>
                            <div class="row"></div>';

                //echo $calendar;
                ?>
            </div>
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