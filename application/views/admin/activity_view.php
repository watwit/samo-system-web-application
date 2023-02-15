<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>กิจกรรม</title>
    <script type="text/javascript">
        $(function() {
            var optsDate = {
                format: 'Y-m-d', // รูปแบบวันที่ 
                formatDate: 'Y-m-d',
                timepicker: false,
                closeOnDateSelect: true,
            }
            var setDateFunc = function(ct, obj) {
                // var minDateSet = $("#date").val();
                // var maxDateSet = $("#date2").val();

                if ($(obj).attr("id") == "date") { //กดเริ่ม
                    this.setOptions({
                        minDate: true,
                        maxDate: false
                    })
                }
                if ($(obj).attr("id") == "date1") {
                    this.setOptions({
                        minDate: true,
                        maxDate: false
                    })
                }
            }
            $("#date,#date1").datetimepicker($.extend(optsDate, {
                onShow: setDateFunc,
                onSelectDate: setDateFunc,
            }));
        });
    </script>
    <script>
        function updateClick(element) {
            var activity_id = $(element).data('activity_id');
            var date = $(element).data('date');
            var activity_name = $(element).data('activity_name');
            var time = $(element).data('time');
            //set value to modal
            $('#activity_id1').val(activity_id);
            $('#date1').val(date);
            $('#activity_name1').val(activity_name);
            $('#time1').val(time);
            document.getElementById("date1").disabled = false;
            document.getElementById("activity_name1").disabled = false;
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            if(date<=today){
                document.getElementById("date1").disabled = true;
                document.getElementById("activity_name1").disabled = true;
            }
            //open modal
            $('#formEditActivity').modal('show');
        };

        function onDelete() {
            if (confirm('คุณต้องการลบรายการนี้หรือไม่?')) {
                return true;
                // document.myform.submit();
            } else {
                return false;
            }

        }
        /////////////////////////////////////////
        $(function() {
            $('.checkbox-toggle').click(function() {
                var clicks = $(this).data('clicks')
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
        //////////////////////////////////
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
                            <h1>จัดการกิจกรรม</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title d-inline-block">รายการกิจกรรมทั้งหมด</h3>
                        <!-- Button delete-->
                        <!-- <button onclick="submitform()" type='submit' class="btn btn-danger float-right ml-2"><i class="fas fa-trash-alt"></i> Delete</button> -->
                        <!-- Button trigger modal -->
                        <button data-toggle="modal" data-target="#formActivity" class="btn btn-primary float-right "><i class="fas fa-folder-plus"></i> เพิ่มข้อมูล</button>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="<?php echo site_url('activity/deleteActivity') ?>" OnSubmit="return onDelete();" name="myform" method="POST">
                                <table class="table table-striped table-bordered text-center table-hover " id="dataTable">
                                    <thead style="background: #61C0BF">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">วันที่</th>
                                            <th scope="col">ชื่อกิจกรรม</th>
                                            <th scope="col">จำนวนชั่วโมงที่ได้รับ</th>
                                            <th scope="col">กำหนดการกิจกรรม</th>
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
                                            $activity_id = $row->activity_id;
                                            $date = $row->date;
                                            $activity_name = $row->activity_name;
                                            $time = $row->amont_of_time; ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $date; ?></td>
                                                <td><?php echo $activity_name; ?></td>
                                                <td><?php echo $time; ?></td>
                                                <td>
                                                    <a href="<?php echo site_url('schedule/show/') . $activity_id ?>" class="btn btn-info" name="add"><i class="fab fa-sistrix"></i></a>
                                                </td>
                                                <td><button data-activity_id="<?php echo $activity_id; ?>" data-date="<?php echo $date; ?>" data-activity_name="<?php echo $activity_name; ?>" data-time="<?php echo $time; ?>" onclick="updateClick(this)" type="button" class="btn btn-secondary "><i class="fas fa-pencil-alt"></i> Edit
                                                    </button></td>
                                                <td><input class="form-check-input mt-2 mx-auto" type="checkbox" name="delete_id[]" value="<?php echo $activity_id; ?>"></td>
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
        <div class="modal fade" id="formActivity" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">เพิ่มข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo site_url('activity/insert') ?>" method="post">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <input type="hidden" name="activity_id" id="activity_id" value="">
                                <div class="row input-group form-group ">
                                    <p for="date" class="col-2 mx-auto">วันที่* </p>
                                    <input type="text" name="date" id="date" class="form-control col-8 mx-auto" value="" required autocomplete="off">
                                </div>
                                <div class="row input-group form-group">
                                    <p for="ctivity_name" class="col-2 mx-auto">กิจกรรม*</p>
                                    <input type="text" name="activity_name" id="activity_name" class="form-control col-8 mx-auto" value="" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p for="time" class="col-2 mx-auto">จำนวนชั่วโมง*</p>
                                    <input type="number" name="time" min="1" max="8" id="time" class="form-control col-8 mx-auto" value="" placeholder="1-8" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer form-group">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="submit" value="save" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal editdata-->
        <div class="modal fade" id="formEditActivity" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">เเก้ไขข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo site_url('activity/edit') ?>" method="post">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <input type="hidden" name="activity_id1" id="activity_id1" value="">
                                <div class="row input-group form-group ">
                                    <p for="date1" class="col-2 mx-auto">วันที่* </p>
                                    <input type="text" name="date1" id="date1" class="form-control col-8 mx-auto" value="" required autocomplete="off">
                                </div>
                                <div class="row input-group form-group">
                                    <p for="ctivity_name" class="col-2 mx-auto">กิจกรรม*</p>
                                    <input type="text" name="activity_name1" id="activity_name1" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" value="" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p for="time" class="col-2 mx-auto">จำนวนชั่วโมง*</p>
                                    <input type="number" name="time1" min="1" max="8" id="time1" class="form-control col-8 mx-auto" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer form-group">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
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