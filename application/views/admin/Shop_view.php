<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ร้านค้า</title>
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


            $('.editstatusshop').click(function() {
                //get data from edit button
                var shopstatus = $(this).attr('data-shopstatus');
                //set value to modal
                $('#shopstatus1').val(shopstatus);
                //open modal
                $('#formEditstatusshop').modal('show');
            });

        });

        function updateClick(element) {
            var shop_id = $(element).data('shop_id');
            var price = $(element).data('price');
            var name = $(element).data('name');
            var detail = $(element).data('detail');
            var status = $(element).data('status');
            var status = $(element).data('status');
            var picture = $(element).data('picture');
            //set value to modal
            $("#picture1").val(null);
            $('#shop_id1').val(shop_id);
            $('#picture_befor').val(picture);
            $('#price1').val(price);
            $('#name1').val(name);
            $('#detail1').val(detail);
            $('#status1').val(status);
            $('#imgUpload1').hide();
            $('#show_old_picture').prop('src', 'img/' + picture);
            $('#show_old_picture').show();
            //open modal
            $('#formEditshop').modal('show');
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

        function onDelete() {
            if (confirm('คุณต้องการลบรายการนี้หรือไม่?')) {
                return true;
                // document.myform.submit();
            } else {
                return false;
            }

        }

        function submitform() {
            if (confirm('Are you sure,you want to delete this item?')) {
                document.myform.submit();
            }
        }

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
                            <h1>จัดการร้านค้า</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title d-inline-block">รายการสินค้าทั้งหมด</h3>
                        <br><br>
                        <?php
                        foreach ($sta as $row) {
                            $shopstatus = $row->shopstatus ?>
                        <?php } ?>
                        <button type="button" class="btn btn-primary  editstatusshop float-left m-1" data-shopstatus="<?php echo $shopstatus; ?>" data-toggle="modal" data-target="#Editstatus"><i class="fas fa-clock"></i></i> สถานะร้านค้า</button>
                        <p class="font-weight-bold float-left m-1" style="font-size :25px">สถานะ : <?php echo $shopstatus; ?></p>
                        <!-- Modal -->
                        <div class="modal fade" id="formEditstatusshop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="IDModalCenterTitle">สถานะ</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo base_url('Shop/editStatus') ?>" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row input-group form-group">
                                                    <p class="col-4 mx-auto">สถานะ *</p>
                                                    <select class="form-control col-8 mx-auto" name="shopstatus1" id="shopstatus1" required>
                                                        <option value="เปิด">เปิด</option>
                                                        <option value="ปิด">ปิด</option>
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

                        <!-- Button trigger modal -->
                        <button data-toggle="modal" data-target="#IDModalCenter" class="btn btn-primary float-right "><i class="fas fa-folder-plus"></i> เพิ่มข้อมูล</button>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="<?php echo site_url('Shop/delete') ?>" OnSubmit="return onDelete();" name="myform" method="POST">
                                <table id="dataTable" class="table table-striped table-bordered text-center text-center">
                                    <thead style="background: #61C0BF">
                                        <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">รูป</th>
                                            <th scope="col">ชื่อสินค้า</th>
                                            <th scope="col">ราคา</th>
                                            <th scope="col">รายละเอียด</th>
                                            <th scope="col">สถานะ</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">
                                                <!-- Check all button -->
                                                <button type="button" class="btn  btn-sm checkbox-toggle m-1"><i class="far fa-square"></i>
                                                    <button type="submit" class="btn  btn-sm m-1"><i class="far fa-trash-alt"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($query as $row) {
                                            $shop_id = $row->shop_id;
                                            $picture = $row->pic;
                                            $name = $row->name;
                                            $price = $row->price;
                                            $detail = $row->detail;
                                            $status = $row->status; ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><img src="<?php echo base_url('img'); ?>/<?php echo $picture; ?>" width="50px"></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $price; ?></td>
                                                <td><?php echo $detail; ?></td>
                                                <td><?php echo $status; ?></td>
                                                <td><button data-shop_id="<?php echo $shop_id; ?>" data-price="<?php echo $price; ?>" data-name="<?php echo $name; ?>" data-detail="<?php echo $detail; ?>" data-status="<?php echo $status; ?>" data-picture="<?php echo $picture; ?>" onclick="updateClick(this)" type="button" class="btn btn-secondary "><i class="fas fa-pencil-alt"></i> Edit
                                                    </button></td>
                                                <!-- <td><a href="<?php echo site_url('Shop/delete') . $shop_id ?>" onclick="return confirm('Are you sure,you want to delete this item?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a></td> -->
                                                <td><input class="form-check-input mt-2 mx-auto" type="checkbox" name="delete_id[]" value="<?php echo $shop_id; ?>"></td>
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
        <div class="modal fade" id="IDModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">เพิ่มข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url('Shop/insert') ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <input type="hidden" name="picture_befor" id="picture_befor" value="">
                                <div class="row input-group form-group">
                                    <p class="col-4 mx-auto">รูป</p>
                                    <div class="col-8 mx-auto">
                                        <input type="file" name="picture" id="picture" class="form-control custom-file-input1" accept="image/*">
                                    </div>
                                    <figure class="figure text-center d-none mt-3 ml-2 mx-auto">
                                        <img id="imgUpload" class="figure-img img-fluid  rounded" alt="" width="200x">
                                    </figure>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-4 mx-auto">ชื่อสินค้า *</p>
                                    <input type="text" name="name" id="name" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p for="time" class="col-4 mx-auto">ราคา *</p>
                                    <input type="number" name="price" min="1" id="price" class="form-control col-8 mx-auto" value="" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-4 mx-auto">รายละเอียด *</p>
                                    <input type="text" name="detail" id="detail" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-4 mx-auto">สถานะ *</p>
                                    <select class="form-control col-8 mx-auto" name="status" id="status" required>
                                        <option value="มีสินค้า">มีสินค้า</option>
                                        <option value="สินค้าหมด">สินค้าหมด</option>
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
        <div class="modal fade" id="formEditshop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="IDModalCenterTitle">เเก้ไขข้อมูล</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url('Shop/edit') ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <input type="hidden" name="shop_id1" id="shop_id1" value="">
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
                                    <p class="col-4 mx-auto">ชื่อสินค้า *</p>
                                    <input type="text" name="name1" id="name1" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p for="time" class="col-4 mx-auto">ราคา *</p>
                                    <input type="number" name="price1" min="1" id="price1" class="form-control col-8 mx-auto" value="" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-4 mx-auto">รายละเอียด *</p>
                                    <input type="text" name="detail1" id="detail1" class="form-control col-8 mx-auto" onKeyUp="if(!(isNaN(this.value))&& this.value.length>0) { alert('กรุณากรอกอักษร'); this.value='';}" required>
                                </div>
                                <div class="row input-group form-group">
                                    <p class="col-4 mx-auto">สถานะ *</p>
                                    <select class="form-control col-8 mx-auto" name="status1" id="status1" required>
                                        <option value="มีสินค้า">มีสินค้า</option>
                                        <option value="สินค้าหมด">สินค้าหมด</option>
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

        <!-- footer -->
        <?php $this->load->view('admin/footer') ?>
    </div>
    <!-- ./wrapper -->
</body>

</html>