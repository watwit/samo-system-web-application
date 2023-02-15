<!DOCTYPE html>
<html>
<head>
	<title>ล็อกอิน</title>
</head>
<body>


    <nav class="pt-2 pb-2  bg-dark text-white" style="font-size :30px;font-family: 'Kanit', sans-serif;">
        <!-- <nav class="pt-2 pb-2" style="background-color: #FFB6B9;font-size :30px"> -->
        <p class="text-center font-weight-bold">สโมสรนิสิตคณะวิศวกรรมศาสตร์ ศรีราชา</p>
    </nav>
    <?php if($this->session->flashdata('msg_login')){ ?>
        <div class="alert alert-danger col-3 mt-2 mx-auto">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <?php echo $this->session->flashdata('msg_login') ?>
        </div>
    <?php }?>
    <div class="container">
        <div class="card card-login col-5 mx-auto text-center bg-dark mt-5">
            <div class="card-header mx-auto bg-dark">
                <span> <img src="<?php echo base_url('img');?>/samo.png" width="70px" alt="Logo"> </span><br />
                <span class="logo_title mt-5 text-light"> สโมสรนิสิตคณะวิศวกรรมศาสตร์ ศรีราชา </span>


            </div>
            <div class="card-body">
                <form action="<?php echo site_url('login/checkLogin')?>" method="post">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="username" class="form-control" placeholder="Username"required autocomplete="off">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Password"required>
                    </div>

                    <div class="form-group">
                        <!-- <a href="<?php echo base_url('login/forgetpassword')?>"class="float-left"><u>ลืมรหัสผ่านใช่หรือไม่?</u></a> -->
                        <input type="submit" name="submit" value="เข้าสู่ระบบ" class="btn btn-outline-success float-right ">
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>
