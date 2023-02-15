<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ของรางวัล</title>
    <script>
        $(document).ready(function() {
            $('.custom-file-input1').on('change', function() {
                
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

        function updateClick(element) {
            var award_id = $(element).data('award_id');
                var award_name = $(element).data('award_name');
                var picture = $(element).data('picture');
                var amont_of_time = $(element).data('amont_of_time');
                //set value to modal
                $("#picture1").val(null);
                $('#award_id1').val(award_id);
                $('#award_name1').val(award_name);
                $('#amont_of_time1').val(amont_of_time);
                $('#picture_befor').val(picture);
                $('#imgUpload1').hide();
                $('#show_old_picture').prop('src', 'img/' + picture);
                $('#show_old_picture').show();
                //open modal
                $('#IDModalCenter1').modal('show');
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
                            <h1>จัดการของรางวัล</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title d-inline-block">รายการของรางวัลทั้งหมด</h3>
                        <!-- Button trigger modal -->
                        <button data-toggle="modal" data-target="#formAward" class="btn btn-primary float-right"><i class="fas fa-folder-plus"></i> เพิ่มข้อมูล</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                        <form action="<?php echo site_url('award/delete') ?>"OnSubmit="return onDelete();"  name="myform" method="POST">
                            <table class="table table-striped table-bordered text-center " id="dataTable">
                                <thead style="background: #61C0BF">
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ของรางวัล</th>
                                        <th scope="col">รูป</th>
                                        <th scope="col">ต้องทำกิจกรรมอย่างน้อย (%)</th>
                                        <th scope="col">กิจกรรมที่ต้องทำ</th>
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
                                        $award_id = $row->award_id;
                                        $award_name = $row->award_name;
                                        $picture = $row->picture;
                                        $amont_of_time = $row->amont_of_time; ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $award_name; ?></td>
                                            <td><img src="<?php echo base_url('img'); ?>/<?php echo $picture; ?>" width="50px"></td>
                                            <td><?php echo $amont_of_time; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('checkaward/show/') . $award_id ?>" class="btn btn-info" name="add"><i class="fab fa-sistrix"></i></a>
                                            </td>
                                            <td><button data-award_id="<?php echo $award_id; ?>"
                                                        data-award_name="<?php echo $award_name; ?>"
                                                        data-picture="<?php echo $picture; ?>" 
                                                        data-amont_of_time="<?php echo $amont_of_time; ?>" 
                                                        onclick="updateClick(this)" type="button" class="btn btn-secondary " ><i class="fas fa-pencil-alt"></i> Edit
                                            </button></td>
                                            
                                            <!-- <td><button data-award_id="<?php echo $award_id; ?>"  data-award_name="<?php echo $award_name; ?>"  onclick="updateClick(this)" type="button" class="btn btn-secondary "><i class="fas fa-pencil-alt"></i> Edit
                                                    </button></td> -->
                                                <td><input class="form-check-input mt-2 mx-auto" type="checkbox" name="delete_id[]" value="<?php echo $award_id; ?>"></td>
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
        <div class="modal fade" id="formAward" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">เพิ่มของรางวัล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo site_url('award/insert') ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row input-group form-group">
                                    <p class="col-4 mx-auto">ชื่อของรางวัล*</p>
                                    <input name="award_name" id="award_name" type="text" class="form-control col-8 mx-auto" name="activity"onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">รูป</p>
                                    <div class="col-8 mx-auto">
                                        <input type="file" name="picture" id="picture" class="form-control custom-file-input1" accept="image/*">
                                    </div>
                                    <figure class="figure text-center d-none mt-3 ml-2 mx-auto">
                                        <img id="imgUpload" class="figure-img img-fluid  rounded" alt="" width="200x">
                                    </figure>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-6 mx-auto">ต้องทำกิจกรรมอย่างน้อย (%)*</p>
                                    <input name="amont_of_time" id="amont_of_time" type="number" min=1 max=100 class="form-control col-6 mx-auto" name="activity"placeholder="1-100" required>
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
        <div class="modal fade" id="IDModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">เพิ่มของรางวัล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo site_url('award/edit') ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <input type="hidden" name="award_id1" id="award_id1" value="">
                                <input type="hidden" name="picture_befor" id="picture_befor" value="">
                                <div class="row input-group form-group">
                                    <p class="col-4 mx-auto">ชื่อของรางวัล*</p>
                                    <input name="award_name1" id="award_name1" type="text" class="form-control col-8 mx-auto" name="activity"onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" value="" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-3 mx-auto">รูป</p>
                                    <div class="col-8 mx-auto">
                                        <input type="file" name="picture1" id="picture1" class="form-control custom-file-input-edit" value="" accept="image/*">
                                    </div>
                                    <figure class="figure text-center d-none mt-3 ml-2 mx-auto">
                                        <img id="imgUpload1" class="figure-img img-fluid  rounded" src="<?php echo base_url('img'); ?>/samo.png" alt="" width="200x">
                                    </figure>
                                    <img id="show_old_picture" name="show_old_picture" class="img-fluid  rounded  mt-3 ml-2 mx-auto" src="" alt="" width="200x">
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-6 mx-auto">ต้องทำกิจกรรมอย่างน้อย (%)*</p>
                                    <input name="amont_of_time1" type="number" min=1 max=100 id="amont_of_time1" class="form-control col-6 mx-auto" name="activity" value="" required>
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