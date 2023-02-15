<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>กำหนดการ</title>
    <script>
        function updateClick(element) {
            //get data from edit button
            var schedule_id = $(element).data('schedule_id');
            var time = $(element).data('time');
            var schedule_name = $(element).data('schedule_name');
            var note = $(element).data('note');
            var activity_id = $(element).data('activity_id');
            //set value to modal
            $('#activity_id').val(activity_id);
            $('#schedule_id').val(schedule_id);
            $('#time').val(time);
            $('#schedule_name').val(schedule_name);
            $('#note').val(note);
            //open modal
            $('#formEditSchedule').modal('show');
        };
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
                        <div class="col-sm-8">
                            <h1>จัดการกำหนดการกิจกรรม <?php echo !empty($name_activity[0]->activity_name)? $name_activity[0]->activity_name:' ';?>  <?php echo !empty($name_activity[0]->date) ?$name_activity[0]->date:' ' ;?></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title d-inline-block">รายการกำหนดการกิจกรรมทั้งหมด</h3>
                        <!-- Button delete-->
                        <!-- <button onclick="submitform()" type='submit' class="btn btn-danger float-right ml-2"><i class="fas fa-trash-alt"></i> Delete</button> -->

                        <!-- Button trigger modal -->
                        <button data-toggle="modal" data-target="#formSchedule" class="btn btn-primary float-right"><i class="fas fa-folder-plus"></i> เพิ่มข้อมูล</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="<?php echo site_url('schedule/deleteSchedule') ?>" name="myform" method="POST">
                                <table class="table table-striped table-bordered text-center table-hover" id="dataTable">
                                    <thead style="background: #61C0BF">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">เวลา</th>
                                            <th scope="col">กิจกรรม</th>
                                            <th scope="col">หมายเหตุ</th>
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
                                            $schedule_id = $row->schedule_id;
                                            $activity_id = $row->activity_id;
                                            $time = $row->time;
                                            $schedule_name = $row->schedule_name;
                                            $note = $row->note; ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $time; ?></td>
                                                <td><?php echo $schedule_name; ?></td>
                                                <td><?php echo $note; ?></td>
                                                <td><button data-activity_id="<?php echo $activity_id; ?>" data-schedule_id="<?php echo $schedule_id; ?>" data-time="<?php echo $time; ?>" data-schedule_name="<?php echo $schedule_name; ?>" data-note="<?php echo $note; ?>" onclick="updateClick(this)" type="button" class="btn btn-secondary "><i class="fas fa-pencil-alt"></i> Edit
                                                    </button></td>
                                                <td><input class="form-check-input mt-2 mx-auto" type="checkbox" name="delete_id[]" value="<?php echo $schedule_id; ?>"></td>
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
        <div class="modal fade" id="formSchedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">เพิ่มกำหนดการกิจกรรม</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo site_url('schedule/insert') ?>" OnSubmit="return onDelete();" method="POST">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row input-group form-group ">
                                    <p class="col-2 mx-auto">เวลา* </p>
                                    <input type="time" name="time" class="form-control col-8 mx-auto" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-2 mx-auto">กิจกรรม*</p>
                                    <input type="text" class="form-control col-8 mx-auto" name="schedule_name" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-2 mx-auto">หมายเหตุ</p>
                                    <input type="text" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" name="note">
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
        <div class="modal fade" id="formEditSchedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">เเก้ไขกำหนดการกิจกรรม</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo site_url('schedule/edit') ?>" method="POST">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <input type="hidden" name="schedule_id" id="schedule_id" value="">
                                <input type="hidden" name="activity_id" id="activity_id" value="">
                                <div class="row input-group form-group ">
                                    <p class="col-2 mx-auto">เวลา* </p>
                                    <input type="time" name="time" id="time" class="form-control col-8 mx-auto" value="" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-2 mx-auto">กิจกรรม*</p>
                                    <input type="text" class="form-control col-8 mx-auto" name="schedule_name" id="schedule_name" value="" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-2 mx-auto">หมายเหตุ</p>
                                    <input type="text" class="form-control col-8 mx-auto" name="note" id="note" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" value="-">
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