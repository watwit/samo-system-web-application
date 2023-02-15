<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายละเอียดของรางวัล</title>
    <script>
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
                            <h1>กิจกรรมที่ต้องทำเพื่อให้ได้ <?php echo !empty($show_name[0]->award_name)? $show_name[0]->award_name:'ของรางวัล';?></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title d-inline-block">รายละเอียดกิจกรรมที่ต้องทำทั้งหมด</h3>
                        <!-- Button trigger modal -->
                        <button data-toggle="modal" data-target="#formCheckAward" class="btn btn-primary float-right"><i class="fas fa-folder-plus"></i> เพิ่มข้อมูล</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                        <form action="<?php echo site_url('checkaward/delete') ?>"OnSubmit="return onDelete();"  name="myform" method="POST">
                            <table class="table table-striped table-bordered text-center text-center" id="dataTable">
                                <thead style="background: #61C0BF">
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">กิจกรรม</th>
                                        <th scope="col">จำนวนชั่วโมง</th>
                                        <th scope="col">วันที่</th>
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
                                        $checkaward_id = $row->checkaward_id;
                                        $activity_name = $row->activity_name;
                                        $amont_of_time = $row->amont_of_time;
                                        $date = $row->date;
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $activity_name; ?></td>
                                            <td><?php echo $amont_of_time; ?></td>
                                            <td><?php echo $date; ?></td>
                                            <td><input class="form-check-input mt-2 mx-auto" type="checkbox" name="delete_id[]" value="<?php echo $checkaward_id; ?>"></td>
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
        <div class="modal fade" id="formCheckAward" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">เพิ่มกิจกรรม</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo site_url('checkaward/multicheck') ?>" method="post">
                        <div class="modal-body">
                            <p for="time" class="col-8 mx-auto">กิจกรรมที่ต้องเข้าร่วม*</p>
                            <select name="check[]" class="selectpicker" multiple title="">
                                <?php
                                foreach ($groups as $row) {
                                    echo '<option value="' . $row->activity_id . '">' . $row->activity_name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="modal-footer form-group">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="saveja" value="save" class="btn btn-primary">
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