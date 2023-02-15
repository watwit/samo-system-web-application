
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>เช็คชื่อ</title>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            $("#check").change(function() {
            // var selectedVal = $("#myselect option:selected").text();
            // var selectedVal = $("#check option:selected").val();
            // $('#check').val(selectedVal);
            document.formactivityname.submit();
            // console.log(selectedVal);
            });
        });

        // function check_enter(e)//กำหนดให้  function check_enter ทำงานเมื่อ มีการกด keyboard
        // {
        //     if (e.keyCode == 13) { //ถ้า e.keyCode เป็น 13 แสดงว่า user กด enter
                
        //         // var element = document.getElementById('acnameja').value;
        //         // $('#name_1').val(element);
        //         // document.song.submit();
        //     }
        // }

        function submitform(){
            if (confirm('Are you sure,you want to delete this item?')){
                document.myform.submit();
            }
            
        }
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
                        <h1>เช็คชื่อ</h1>
                            <p <?php echo isset($_SESSION['namenewactivity_id']) ? 'hidden' : '' ?> class="font-weight-bold " style="font-size: 20px;">-กรุณาเลือกกิจกรรม-*</p>
                            <p <?php echo isset($_SESSION['namenewactivity_id']) ? '' : 'hidden' ?> class="font-weight-bold " style="font-size: 20px;">กิจกรรมที่คุณเลือกอยู่คือ</p>
                            
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-sm-4">
                        
                        <p <?php echo isset($_SESSION['namenewactivity_id']) ? '' : 'hidden' ?> class="label label-success" ><?php echo $_SESSION['namenewactivity_name']." ".$_SESSION['namenewactivity_date']?></p>
                            <form action="<?php echo site_url('namenew/show') ?>"method="post" name="formactivityname" id="formactivityname">
                                <select name="check" id="check" class="custom-select mb-2" value="456" required>
                                <option value="">เลือกกิจกรรม</option>
                                <?php 
                                
                                    foreach($groups as $row)
                                        { 
                                            $namenewactivity_id = $row->activity_id;
                                            $namenewactivity_name = $row->activity_name;
                                            $namenewactivity_date = $row->date;
                                            echo '<option value="'.$namenewactivity_id.','.$namenewactivity_name.','.$namenewactivity_date.'">'.$namenewactivity_date.' '.$namenewactivity_name.'</option>';
                                            
                                        }
                                ?>
                                
                                </select>


                                <!-- <div class="modal-footer form-group">
                                    <input type="submit" name="saveja" value="save" class="btn btn-primary">
                                </div> -->
                            
                            </form>
                        </div>
                        
                        <div class="col-sm-3">
                        <p <?php echo isset($_SESSION['namenewstudent_id']) ? '' : 'hidden' ?> class="label" style="color: #E5E5E5">.</p>
                            <form class="form-inline " action="<?php echo site_url('namenew/insert') ?>"method="POST" name="song">

                            <input  <?php echo isset($_SESSION['namenewactivity_id']) ? 'enabled' : 'disabled' ?>  class="form-control "  name="name_1" id="name_1" value="" type="text" autofocus placeholder="-กรอกรหัสนิสิต-"onKeyUp="if(isNaN(this.value)&& this.value.length>0){ alert('กรุณากรอกตัวเลข'); this.value='';}" autocomplete="off">
                            </form>
                        </div>
                    </div><!-- /.container-fluid -->
                </div><!-- /.container-fluid -->
               
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title d-inline-block">รายชื่อนิสิตที่เข้าร่วมกิจกรรม</h3>
                        <!-- Button delete-->
                        <!-- <button onclick="submitform()" type='submit' class="btn btn-danger float-right ml-2"><i class="fas fa-trash-alt"></i> Deleteที่เลือก</button> -->
                    


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="<?php echo site_url('namenew/delete') ?>"  name="myform" method="POST">
                                <table class="table table-striped table-bordered text-center table-hover "  id="dataTable">
                                <thead style="background: #61C0BF">
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                         <th scope="col">รหัสนิสิต</th>
                                         <th scope="col">ชื่อ-นามสกุล</th>
                                         <th scope="col">สาขา</th>
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
                                        $checkname_id = $row->checkname_id;
                                        $student_id = $row->student_id;
                                        $student_name = $row->student_name;
                                        $student_major = $row->major_code;
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $student_id; ?></td>
                                            <td><?php echo $student_name; ?></td>
                                            <td><?php echo $student_major; ?></td>
                                            <td><input class="form-check-input mt-2 mx-auto" type="checkbox" name="delete_id[]" value="<?php echo $checkname_id; ?>"></td>
                                        </tr>
                                    <?php }?>
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
        



        
        <!-- footer -->
        <?php $this->load->view('admin/footer') ?>
    </div>
    <!-- ./wrapper -->
</body>


</html>