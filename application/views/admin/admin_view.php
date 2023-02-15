<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>จัดการเเอดมิน</title>
    <script>
        function check_char(elm) {
            if (!elm.value.match(/^[a-z0-9_]+$/i) && elm.value.length > 0) {
                alert('กรอกได้เฉพาะ a-z , 0-9 เเละ  _ (underscore) เท่านั้น');
                elm.value = '';
            }
        }
        function updateClick(element) {
            var user_id = $(element).data('user_id');
            var firstname = $(element).data('firstname');
            var lastname = $(element).data('lastname');
            var permission = $(element).data('permission');
            var username = $(element).data('username');
            //set value to modal
            $('#username1').val(username);
            $('#user_id1').val(user_id);
            $('#firstname1').val(firstname);
            $('#lastname1').val(lastname);

            if (user_id == '1') {
                $('#permission1').hide();
                $('#labelpermission1').hide();
            } else {
                $('#labelpermission1').show();
                $('#permission1').val(permission).show();
            }
            //open modal
            $('#formEditAdmin').modal('show');
        };
        //form delete
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
                            <h1>จัดการแอดมิน</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title d-inline-block">รายการแอดมินทั้งหมดทั้งหมด</h3>
                        <!-- Button delete-->
                        <!-- <button onclick="submitform()" type='submit' class="btn btn-danger float-right ml-2"><i class="fas fa-trash-alt"></i> Delete</button> -->
                        <!-- Button trigger modal -->
                        <button data-toggle="modal" data-target="#formAdmin" class="btn btn-primary float-right"><i class="fas fa-folder-plus"></i> เพิ่มข้อมูล</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="<?php echo site_url('admin/deleteAdmin') ?>" OnSubmit="return onDelete();" name="myform" method="POST">
                                <table class="table table-striped table-bordered text-center table-hover" id="dataTable">
                                    <thead style="background: #61C0BF">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">username</th>
                                            <th scope="col">first name</th>
                                            <th scope="col">last name</th>
                                            <th scope="col">pemission</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">
                                                <!-- Check all button -->
                                                <button type="button" class="btn  btn-sm checkbox-toggle m-1"><i class="far fa-square"></i>
                                                    <button type="submit" class="btn  btn-sm m-1"><i class="far fa-trash-alt"></i></button>
                                            </th>
                                            <!-- <th scope="col">Save</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($query as $row) {
                                            $user_id = $row->user_id;
                                            $username = $row->username;
                                            $firstname = $row->firstname;
                                            $lastname = $row->lastname;
                                            $permission = $row->permisstion; ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $username; ?></td>
                                                <td><?php echo $firstname; ?></td>
                                                <td><?php echo $lastname; ?></td>
                                                <td><span class="badge badge-warning mt-2"><?php echo $permission; ?></span></td>
                                                <td><button data-user_id="<?php echo $user_id; ?>" data-username="<?php echo $username; ?>" data-firstname="<?php echo $firstname; ?>" data-lastname="<?php echo $lastname; ?>" data-permission="<?php echo $permission; ?>" onclick="updateClick(this)" type="button" class="btn btn-secondary "><i class="fas fa-pencil-alt"></i> Edit
                                                    </button></td>
                                                <?php if ($user_id != 1) { ?>
                                                    <td><input class="form-check-input mt-2 mx-auto" type="checkbox" name="delete_id[]" value="<?php echo $user_id; ?>"></td>
                                                    <!-- <td><a href="<?php echo site_url('admin/delete/') . $user_id ?>" onclick="return confirm('Are you sure,you want to delete this item?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a></td> -->
                                                <?php } else { ?>
                                                    <td><i class="fas fa-ban mt-2 mx-auto"></i></td>
                                                <?php } ?>
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
        <div class="modal fade" id="formAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">เพิ่มข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo site_url('admin/insert') ?>" method="post">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row input-group form-group ">
                                    <p class="col-4 mx-auto">username*</p>
                                    <input type="text" name='username' id='username' class="form-control col-8 mx-auto" onkeyup='check_char(this)' &nbsp required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-4 mx-auto">first name*</p>
                                    <input type="text" name='firstname' class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-4 mx-auto">last name*</p>
                                    <input type="txet" name='lastname' class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-4 mx-auto">password*</p>
                                    <input type="password" name='password' class="form-control col-8 mx-auto" maxlength=14 minlength=6 placeholder="6 - 14 character" required>
                                </div>
                                <div class="form-group row">
                                    <p class="col-4 mx-auto">permission*</p>
                                    <div class="col-8 mx-auto">


                                        <select class="custom-select" name="permission" id="permission" required>
                                            <option value="" disabled selected>Select Permission</option>
                                            <option value="admin">admin</option>
                                            <option value="superadmin">superadmin</option>
                                        </select>
                                    </div>
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
        <div class="modal fade" id="formEditAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">เเก้ไขข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo site_url('admin/edit') ?>" method="post">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <input type="hidden" name="user_id1" id="user_id1" value="">
                                <div class="row input-group form-group">
                                    <p class="col-4 mx-auto">username</p>
                                    <input type="text" disabled class="form-control col-8 mx-auto" name="username1" id="username1"  value="">
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-4 mx-auto">first name*</p>
                                    <input type="text" name='firstname1' id="firstname1" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" value="" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-4 mx-auto">last name*</p>
                                    <input type="txet" name='lastname1' id="lastname1" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" value="" required>
                                </div>
                                <div class="form-group row">
                                    <p class="col-4 mx-auto" name="labelpermission1" id="labelpermission1">permission*</p>
                                    <div class="col-8 mx-auto">
                                        <select class="custom-select" name="permission1" id="permission1" value="" required>
                                            <option value="admin">admin</option>
                                            <option value="superadmin">superadmin</option>
                                        </select>
                                    </div>
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