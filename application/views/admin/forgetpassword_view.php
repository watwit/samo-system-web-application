<!DOCTYPE html>
<html>
<head>
	<title>ลืมรหัสผ่าน</title>
</head>
<body>

    <nav class="pt-2 pb-2  bg-dark text-white" style="font-size :30px;font-family: 'Kanit', sans-serif;">
        <!-- <nav class="pt-2 pb-2" style="background-color: #FFB6B9;font-size :30px"> -->
        <p class="text-center font-weight-bold">สโมสรนิสิตคณะวิศวกรรมศาสตร์ ศรีราชา</p>
    </nav>
    <div class="container">
        <div class="card card-login col-5 mx-auto text-center bg-dark mt-5">
            <div class="card-header mx-auto bg-dark">
                <span> <img src="<?php echo base_url('img');?>/samo.png" width="70px" alt="Logo"> </span><br />
                <span class="logo_title mt-5 text-light"> สโมสรนิสิตคณะวิศวกรรมศาสตร์ ศรีราชา </span>


            </div>
            <div class="card-body">
                <form action="<?php echo site_url('login/checkLogin')?>" method="post">
                    <p class="float-left">กรอก username ของคุณ</p>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span  class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="username" id="username"class="form-control" placeholder="Username"required>
                    </div>

                    <!-- <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Password"required>
                    </div> -->

                    <div class="form-group">
                        <input type="submit" name="submit" value="ยืนยัน" class="btn btn-outline-success float-right ">
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>