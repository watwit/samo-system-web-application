<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ทำเนียบ</title>
    <script>
        $(document).ready(function() {

            $('.custom-file-input1').on('change', function() {
                var fileName = $(this).val().split('\\').pop()
                //$(this).siblings('.custom-file-label').html(fileName)
                if (this.files[0]) {
                    var reader = new FileReader()
                    $('.figure').addClass('d-block')
                    reader.onload = function(e) {
                        $('#imgUpload').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0])
                }
            })

            $('.custom-file-input-edit').on('change', function() {
                //var fileName = $(this).val().split('\\').pop()
                //$(this).siblings('.custom-file-label').html(fileName)
                if (this.files[0]) {
                    var reader = new FileReader()
                    $('.figure').addClass('d-block')
                    reader.onload = function(e) {
                        $('#show_old_picture').hide()
                        $('#imgUpload1').attr('src', e.target.result);
                        $('#imgUpload1').show();
                    }
                    reader.readAsDataURL(this.files[0])
                }
            })
            $("#rank").change(function() {

                // var selectedVal = $("#myselect option:selected").text();
                var selectedVal = $("#rank option:selected").val();
                if (selectedVal == '24') {
                    $('form input[id="rankother"]').prop("disabled", false);
                } else {
                    $('form input[id="rankother"]').prop("disabled", true);
                    $('#rankother').val("");
                }

            });
            $("#rank1").change(function() {

                // var selectedVal = $("#myselect option:selected").text();
                var selectedVal = $("#rank1 option:selected").val();
                if (selectedVal == '24') {
                    $('form input[id="rankother1"]').prop("disabled", false);
                } else {
                    $('form input[id="rankother1"]').prop("disabled", true);
                    $('#rankother1').val("");
                }

            });
        });

        function onDelete() {
            if (confirm('คุณต้องการลบรายการนี้หรือไม่?')) {
                return true;
                // document.myform.submit();
            } else {
                return false;
            }

        }
        $(function() {
            //Enable check and uncheck all functionality
            $('.checkbox-toggle').click(function() {
                var clicks = $(this).data('clicks')
                console.log(clicks)
                if (clicks) {
                    //Uncheck all checkboxes
                    $(' input[type=\'checkbox\']').prop('checked', false)
                    $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
                } else {
                    //Check all checkboxes
                    $(' input[type=\'checkbox\']').prop('checked', true)
                    $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
                }
                $(this).data('clicks', !clicks)
                console.log($(this).data('clicks', !clicks))
            })
        })
    </script>
    <script>
        function updateClick(element) {
            //get data from edit button
            var palace_id = $(element).data('palace_id');
            var student_id = $(element).data('student_id');
            // var sex = $(element).data('sex');
            var name = $(element).data('name');
            var arrstd_name = name.split(" ");
            var fname = '';
            var lname = '';
            for (var i = 0; i < arrstd_name.length; i++) {
                if (i == 0) {
                    fname += arrstd_name[i];
                } else if (i == (arrstd_name.length) - 1) {
                    lname += arrstd_name[i];
                } else {
                    lname += arrstd_name[i] + ' ';
                }
            }
            var major_id = $(element).data('major_id');
            var rank = $(element).data('rank');
            var picture = $(element).data('picture');
            //set value to modal
            if (rank == '10' ||
                rank == '11' ||
                rank == '12' ||
                rank == '13' ||
                rank == '14' ||
                rank == '15' ||
                rank == '16' ||
                rank == '17' ||
                rank == '18' ||
                rank == '19' ||
                rank == '20' ||
                rank == '21' ||
                rank == '22' ||
                rank == '23') {
                $("#picture1").val(null);
                $('#palace_id1').val(palace_id);
                $('#picture_befor').val(picture);
                $('#student_id1').val(student_id);
                // $('#sex1').val(sex);
                $('#fname1').val(fname);
                $('#lname1').val(lname);
                $('#major1').val(major_id);
                // $('#sex1').val(sex);
                $('#rank1').val(rank);
                $('#rankother1').val("");
                $('#rankother1').prop("disabled", true);
                $('#imgUpload1').hide();
                $('#show_old_picture').prop('src', 'img/' + picture);
                $('#show_old_picture').show();
                //open modal

                $('#formEditpalace').modal('show');
            } else {
                $("#picture1").val(null);
                $('#palace_id1').val(palace_id);
                $('#picture_befor').val(picture);
                $('#student_id1').val(student_id);
                // $('#sex1').val(sex);
                $('#fname1').val(fname);
                $('#lname1').val(lname);
                $('#major1').val(major_id);
                $('#rank1').val('24');
                $('#rankother1').val(rank);
                $('#rankother1').prop("disabled", false);
                $('#imgUpload1').hide();
                $('#show_old_picture').prop('src', 'img/' + picture);
                $('#show_old_picture').show();
                //open modal

                $('#formEditpalace').modal('show');
            }
        };
    </script>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper" style="background-color: #E5E5E5; font-family: 'Kanit', sans-serif">
        <!-- Navbar & Main Sidebar Container -->
        <?php $this->load->view('admin/sidebar') ?>
        <div class="row pt-5"></div>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper " style="background-color: #E5E5E5;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success col-3 mt-2 mx-auto text-center">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <?php echo $this->session->flashdata('success') ?>
                        </div>
                    <?php } ?>
                    <?php if ($this->session->flashdata('check')) { ?>
                        <div class="alert alert-warning col-5 mt-2 mx-auto text-center">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <?php echo $this->session->flashdata('check') ?>
                        </div>
                    <?php } ?>
                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger col-3 mt-2 mx-auto text-center">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <?php echo $this->session->flashdata('error') ?>
                        </div>
                    <?php } ?>
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>จัดการทำเนียบสโม</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title d-inline-block">รายการทำเนียบสโมทั้งหมด</h3>
                        <!-- Button trigger modal -->
                        <button data-toggle="modal" data-target="#formPalace" class="btn btn-primary float-right"><i class="fas fa-folder-plus"></i> เพิ่มข้อมูล</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="<?php echo site_url('palace/delete') ?>" OnSubmit="return onDelete();" name="myform" method="POST">
                                <table id="dataTable" class="table table-striped table-bordered text-center text-center">
                                    <thead style="background: #61C0BF">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">รหัสนิสิต</th>
                                            <th scope="col">ชื่อ-สกุล</th>
                                            <th scope="col">สาขา</th>
                                            <th scope="col">ตำแหน่ง</th>
                                            <th scope="col">รูป</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">
                                                <!-- Check all button -->
                                                <button type="button" class="btn  btn-sm checkbox-toggle m-1"><i class="far fa-square"></i>
                                                    <button type="submit" class="btn  btn-sm m-1"><i class="far fa-trash-alt"></i></button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($query as $row) {
                                            $palace_id = $row->palace_id;
                                            $student_id = $row->student_id;
                                            $name = $row->name;
                                            $major_id = $row->major_id;
                                            $major_name = $row->major_name;
                                            $rank = $row->rank;
                                            $picture = $row->picture;
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
                                            } ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $student_id; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $major_name; ?></td>
                                                <td><?php echo $rankshow; ?></td>
                                                <td><img src="<?php echo base_url('img'); ?>/<?php echo $picture; ?>" width="50px"></td>
                                                <td><button data-palace_id="<?php echo $palace_id; ?>" data-student_id="<?php echo $student_id; ?>" data-name="<?php echo $name; ?>" data-major_id="<?php echo $major_id; ?>" data-rank="<?php echo $rank; ?>" data-picture="<?php echo $picture; ?>" onclick="updateClick(this)" type="button" class="btn btn-secondary "><i class="fas fa-pencil-alt"></i> Edit
                                                    </button></td>
                                                <td><input class="form-check-input mt-2 mx-auto" type="checkbox" name="deletepalace_id[]" value="<?php echo $palace_id; ?>"></td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- modal insertdata-->
        <div class="modal fade" id="formPalace" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">เพิ่มข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url('palace/insert') ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="container-fluid">

                                <div class="row input-group form-group ">
                                    <p class="col-3 mx-auto">รหัสนิสิต *</p>
                                    <input type="text" name="student_id" id="student_id" class="form-control col-8 mx-auto" maxlength=10 minlength=10 onKeyUp="if(isNaN(this.value)&& this.value.length>0){ alert('กรุณากรอกตัวเลข'); this.value='';}" required>
                                </div>
                                <!-- <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">คำนำหน้า *</p>
                                    <select class="form-control col-8 mx-auto" name="sex" id="sex" required>
                                        <option value="">เลือกคำนำหน้า</option>
                                        <option value="นาย">นาย</option>
                                        <option value="นางสาว">นางสาว</option>
                                    </select>
                                </div> -->
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">ชื่อ*</p>
                                    <input name="fname" id="fname" type="text" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">สกุล*</p>
                                    <input name="lname" id="lname" type="text" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">สาขา *</p>
                                    <select class="form-control col-8 mx-auto" name="major" id="major" required>
                                        <option value="">เลือกสาขา</option>
                                        <?php
                                        foreach ($groups as $row) {
                                            $major_id = $row->major_id;
                                            $major_name = $row->major_name;
                                            $major_code = $row->major_code;
                                            echo '<option value="' . $major_id . '">' . $major_name . ' ' . $major_code . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">ตำแหน่ง *</p>
                                    <select class="form-control col-8 mx-auto" name="rank" id="rank" required>
                                        <option value="">เลือกตำแหน่ง</option>
                                        <option value="10">นายก</option>
                                        <option value="11">รองนายก</option>
                                        <option value="12">เลขา</option>
                                        <option value="13">เหรัญญิก</option>
                                        <option value="14">สันทนาการ</option>
                                        <option value="15">บุคคล</option>
                                        <option value="16">สถานที่</option>
                                        <option value="17">จัดซื้อ</option>
                                        <option value="18">ระเบียบ</option>
                                        <option value="19">พยาบาล</option>
                                        <option value="20">สวัสดิการ</option>
                                        <option value="21">วิชาการ</option>
                                        <option value="22">สรุปโครงการ</option>
                                        <option value="23">ประชาสัมพันธ์</option>
                                        <option value="24">อื่นๆ</option>
                                    </select>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">ระบุ *</p>
                                    <input type="text" name="rankother" id="rankother" class="form-control col-8 mx-auto " value="" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" disabled required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">รูป </p>
                                    <div class="col-8 mx-auto">
                                        <input type="file" name="picture" id="picture" class="form-control custom-file-input1" accept="image/*">
                                    </div>
                                    <figure class="figure text-center d-none mt-3 ml-2 mx-auto">
                                        <img id="imgUpload" class="figure-img img-fluid  rounded" alt="" width="200x">
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="submit" value="save" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- modal editdata-->
        <div class="modal fade" id="formEditpalace" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">เเก้ไขข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url('palace/edit') ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <input type="hidden" name="palace_id1" id="palace_id1" value="">
                                <input type="hidden" name="picture_befor" id="picture_befor" value="">
                                <div class="row input-group form-group ">
                                    <p class="col-3 mx-auto">รหัสนิสิต *</p>
                                    <input type="text" name="student_id1" id="student_id1" class="form-control col-8 mx-auto" maxlength=10 minlength=10 onKeyUp="if(isNaN(this.value)&& this.value.length>0){ alert('กรุณากรอกตัวเลข'); this.value='';}" value="" required>
                                </div>
                                <!-- <div class="row input-group form-group">
                                            <p class="col-3 mx-auto">คำนำหน้า *</p>
                                            <select class="form-control col-8 mx-auto" name="sex1" id="sex1" value="" required>
                                                <option value="">เลือกคำนำหน้า</option>
                                                <option value="นาย">นาย</option>
                                                <option value="นางสาว">นางสาว</option>
                                            </select>
                                        </div> -->
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">ชื่อ*</p>
                                    <input name="fname1" id="fname1" type="text" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">สกุล*</p>
                                    <input name="lname1" id="lname1" type="text" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">สาขา *</p>
                                    <select class="form-control col-8 mx-auto" name="major1" id="major1" value="" required>
                                        <?php
                                        foreach ($groups as $row) {
                                            $major_id = $row->major_id;
                                            $major_name = $row->major_name;
                                            $major_code = $row->major_code;
                                            echo '<option value="' . $major_id . '">' . $major_name . ' ' . $major_code . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">ตำแหน่ง *</p>
                                    <select class="form-control col-8 mx-auto" name="rank1" id="rank1" required>
                                        <option value="">เลือกตำแหน่ง</option>
                                        <option value="10">นายก</option>
                                        <option value="11">รองนายก</option>
                                        <option value="12">เลขา</option>
                                        <option value="13">เหรัญญิก</option>
                                        <option value="14">สันทนาการ</option>
                                        <option value="15">บุคคล</option>
                                        <option value="16">สถานที่</option>
                                        <option value="17">จัดซื้อ</option>
                                        <option value="18">ระเบียบ</option>
                                        <option value="19">พยาบาล</option>
                                        <option value="20">สวัสดิการ</option>
                                        <option value="21">วิชาการ</option>
                                        <option value="22">สรุปโครงการ</option>
                                        <option value="23">ประชาสัมพันธ์</option>
                                        <option value="24">อื่นๆ</option>
                                    </select>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">ระบุ *</p>
                                    <input type="text" name="rankother1" id="rankother1" class="form-control col-8 mx-auto " value="" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" disabled required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">รูป </p>
                                    <div class="col-8 mx-auto">
                                        <input type="file" name="picture1" id="picture1" class="form-control custom-file-input-edit" value="" accept="image/*">
                                    </div>
                                    <figure class="figure text-center d-none mt-3 ml-2 mx-auto">
                                        <img id="imgUpload1" class="figure-img img-fluid  rounded" src="<?php echo base_url('img'); ?>/samo.png" alt="" width="200x">
                                    </figure>
                                    <img id="show_old_picture" name="show_old_picture" class="img-fluid  rounded  mt-3 ml-2 mx-auto" src="" alt="" width="200x">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="submit" value="save" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- footer -->
        <?php $this->load->view('admin/footer') ?>
    </div>
    <!-- ./wrapper -->
</body>


</html>