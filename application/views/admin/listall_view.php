<!DOCTYPE html>
<html lang="en">
<script>
    function updateClick(element) {
        var list_id = $(element).data('list_id');
        var student_id = $(element).data('student_id');
        var student_name = $(element).data('student_name');
        var arrstd_name = student_name.split(" ");
        var first_name='';
        var last_name='';
        for(var i=0;i<arrstd_name.length;i++){
           if (i==0){
            first_name += arrstd_name[i];
           }
           else if(i==(arrstd_name.length)-1){
            last_name += arrstd_name[i];
           }
           else{
            last_name += arrstd_name[i]+' ';
           }
        }
        var major_id = $(element).data('major_id');
        //set value to modal
        $('#list_id1').val(list_id);
        $('#student_id1').val(student_id);
        $('#first_name1').val(first_name);
        $('#last_name1').val(last_name);
        $('#major1').val(major_id);
        //open modal
        $('#IDModalCenteredit').modal('show');
    };

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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายชื่อ</title>
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
                    <?php if ($this->session->flashdata('check1')) { ?>
                        <div class="alert alert-warning col-5 mt-2 mx-auto text-center">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <?php echo $this->session->flashdata('check1') ?>
                        </div>
                    <?php } ?>
                    <?php if ($this->session->flashdata('check2')) { ?>
                        <div class="alert alert-warning col-5 mt-2 mx-auto text-center">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <?php echo $this->session->flashdata('check2') ?>
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
                            <h1>จัดการรายชื่อนิสิต</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title d-inline-block">รายการรายชื่อนิสิตทั้งหมด</h3>
                        <!-- Button trigger modal -->
                        <!-- <button onclick="submitform()" type='submit' class="btn btn-danger float-right ml-2"><i class="fas fa-trash-alt"></i> Delete</button> -->
                        <button data-toggle="modal" data-target="#formExcel" class="btn btn-primary float-right ml-2"><i class="fas fa-file-excel"></i> Excel</button>
                        <button data-toggle="modal" data-target="#formListall" class="btn btn-primary float-right ml-2"><i class="fas fa-folder-plus"></i> เพิ่มข้อมูล</button>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="<?php echo site_url('listall/delete') ?>" OnSubmit="return onDelete();" name="myform" method="POST">
                                <table id="dataTable" class="table table-striped table-bordered mydatatable text-center">
                                    <thead style="background: #61C0BF">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">รหัสนิสิต</th>
                                            <th scope="col">ชื่อ-สกุล</th>
                                            <th scope="col">สาขา</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">
                                                <!-- Check all button -->
                                                <button type="button" class="btn  btn-sm checkbox-toggle m-2"><i class="far fa-square"></i>
                                                    <button type="submit" class="btn  btn-sm m-2"><i class="far fa-trash-alt"></i></button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($query as $row) {
                                            $list_id = $row->list_id;
                                            $student_id = $row->student_id;
                                            $student_name = $row->student_name;
                                            $major_code = $row->major_code;
                                            $major_id = $row->major_id; ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $student_id; ?></td>
                                                <td><?php echo $student_name; ?></td>
                                                <td><?php echo $major_code; ?></td>
                                                <td><button data-list_id="<?php echo $list_id; ?>" data-student_id="<?php echo $student_id; ?>" data-student_name="<?php echo $student_name; ?>" data-major_id="<?php echo $major_id; ?>" onclick="updateClick(this)" type="button" class="btn btn-secondary "><i class="fas fa-pencil-alt"></i> Edit
                                                    </button></td>
                                                <td><input class="form-check-input mt-2 mx-auto" type="checkbox" name="deletelist_id[]" value="<?php echo $list_id; ?>"></td>
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
        <div class="modal fade" id="formListall" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">เพิ่มข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo site_url('listall/insert') ?>" method="post">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row input-group form-group ">
                                    <p class="col-3 mx-auto">รหัสนิสิต* </p>
                                    <input name="student_id" id="student_id" type="text" class="form-control col-8 mx-auto" maxlength=10 minlength=10 onKeyUp="if(isNaN(this.value)&& this.value.length>0){ alert('กรุณากรอกตัวเลข'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">ชื่อ*</p>
                                    <input name="first_name" id="first_name" type="text" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">สกุล*</p>
                                    <input name="last_name" id="last_name" type="text" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value)) && this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">สาขา*</p>
                                    <select name="major" id="major" class="form-control col-8 mx-auto" required>
                                        <option value="">เลือกสาขา</option>
                                        <?php 
                                            foreach($groups as $row)
                                                { 
                                                    $major_id = $row->major_id;
                                                    $major_name = $row->major_name;
                                                    $major_code = $row->major_code;
                                                    echo '<option value="'.$major_id.'">'.$major_name.' '.$major_code.'</option>';
                                                }
                                        ?>
                                    </select>
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

        <div class="modal fade" id="IDModalCenteredit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">เเก้ไขข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo site_url('listall/edit') ?>" method="post">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row input-group form-group ">
                                    <p class="col-3 mx-auto">รหัสนิสิต* </p>
                                    <input name="student_id1" id="student_id1" type="text" class="form-control col-8 mx-auto" maxlength=10 minlength=10 onKeyUp="if(isNaN(this.value)&& this.value.length>0){ alert('กรุณากรอกตัวเลข'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">ชื่อ*</p>
                                    <input name="first_name1" id="first_name1" type="text" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">สกุล*</p>
                                    <input name="last_name1" id="last_name1" type="text" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">สาขา*</p>
                                    <select name="major1" id="major1" class="form-control col-8 mx-auto" required>
                                        <option value="">เลือกสาขา</option>
                                        <?php 
                                            foreach($groups as $row)
                                                { 
                                                    $major_id = $row->major_id;
                                                    $major_name = $row->major_name;
                                                    $major_code = $row->major_code;
                                                    echo '<option value="'.$major_id.'">'.$major_name.' '.$major_code.'</option>';
                                                }
                                        ?>
                                    </select>
                                </div>
                                <div class="row input-group form-group ">
                                    <input name="list_id1" id="list_id1" type="hidden" class="form-control col-8 mx-auto">
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


        <!-- Modal Excel-->
        <div class="modal fade" id="formExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo site_url('upload') ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row input-group form-group ">
                                    <p class="col-3 mx-auto">File Excel* </p>
                                    <input class="form-control col-8 mx-auto" type="file" name="fileup" id="fileup"><br>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit" name="btn_submit">Send</button>
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