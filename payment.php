<!--- Back-End --->
<?php

session_start();
include('server.php');

if (isset($_POST['b'])) {
    $room_id = $_POST['b'];
    $check_in = $_POST['Check_in'];
    $check_out = $_POST['Check_out'];

    $sql = "SELECT * FROM room WHERE Room_ID = '" . $room_id . "'";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();

    $start_date = date_create($_POST['Check_in']);
    $end_date = date_create($_POST['Check_out']);
    $day_num = date_diff($start_date, $end_date);
    $day = $day_num->format('%a');
    $final_sum = ($day * $row['Price'] / 2); // final_sum คือ ราคาห้อง*ระยะวันที่พัก/2 ก็คือราคาที่ต้องจ่ายครึ่งนึง
}

if ($_POST['button'] == "confirm") {

    $room_id = $_POST['room_id'];
    $price = $_POST['room_price'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    $sql = "SELECT * FROM user WHERE username ='" . $_SESSION['username'] . "'";
    $result = mysqli_query($conn, $sql);
    $dbarr = $result->fetch_assoc();

    $sql = "INSERT INTO book(Room_num, Check_in, Check_out, Book_user) VALUES('" . $room_id . "','" . $check_in . "', '" . $check_out . "','" . $dbarr['User_ID'] . "')";
    mysqli_query($conn, $sql);

    $bid = mysqli_insert_id($conn); // คืนค่าไอดีที่บันทึกล่าสุด
    $date = $_POST["txtDate"] . " " . $_REQUEST["txtTime"];

    $pid =  'P' . mt_rand(10000, 99999); // สุ่มเลขใบเสร็จห้อง

    $sql = "INSERT INTO payment(Payment_ID, Bank, Price, DatePay, Bk_id) VALUES('" . $pid . "','" . $_POST["txtBank"] . "','" . $price . "','" . $date . "','" . $bid . "')";
    $result = mysqli_query($conn, $sql);

    // เปลี่ยนสถานะห้องถ้าจองแล้วห้องจะกลายเป็น 1
    if ($result) {
        $sql = "UPDATE room SET Status = '1' WHERE Room_ID = '" . $room_id . "'";
        mysqli_query($conn, $sql);
        echo '
            <div class="alert alert-success" role="alert">
            <i class="fa fa-check-circle"></i> ชำระเงินเสร็จสิ้น
            </div>' . "<meta http-equiv='refresh' content='2 ;url=?page=home'>";
    } else {
        echo '
            <div class="alert alert-danger" role="alert">
            <i class="fa fa-times-circle"></i> ชำระเงินไม่สำเร็จ
            </div>';
    }
}
?>
<!--- End Back-End --->

<html>
<!--- start container --->
<div class="container">

    <body>

        <div class="homeheader">
            <h2><b>ยืนยันการชำระเงิน</b></h2>
        </div>
        <br>
        <div class="row justify-content-center">

            <div class="col-md-3 mb-3">

                <div class="card card-body " style="width:100%; height:100% ">

                    <div class="card-body">
                        <img class="img card-img-top" src="images/<?php echo $room_id ?>.jpg"></img>
                        <br><br>
                        <div class="homeheader">
                            <h5><b>รายละเอียด</b></h5>
                        </div>
                        <br>

                        <h6><b>ชื่อผู้ใช้ :</b> <?php echo $_SESSION['username'] ?></h6>
                        <h6><b>ห้องที่ :</b> <?php echo $room_id ?></h6>
                        <h6><b>ราคา :</b> <?php echo $final_sum ?> บาท</h6>
                        <h6><b>เช็คอิน :</b> <?php echo $check_in ?></h6>
                        <h6><b>เช็คเอาท์ :</b> <?php echo $check_out ?></h6>

                    </div>
                </div>
            </div>
        </div>
        <form method="POST">
            <input type="hidden" name="price" value="<?php echo $row['Price']; ?>" />
            <input type="hidden" name="room_id" value="<?php echo $room_id ?>" />
            <input type="hidden" name="room_price" value="<?php echo $final_sum ?>" />
            <input type="hidden" name="check_in" value="<?php echo $check_in ?>" />
            <input type="hidden" name="check_out" value="<?php echo $check_out ?>" />
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="homeheader">
                        <h5><b>ชำระเงิน</b></h5>
                    </div>
                    <br>
                    <label><b>ธนาคาร</b></label>
                    <select name="txtBank" class="form-control">
                        <option value="BBL">Bangkok Bank</option>
                        <option value="KTB">Krungthai Bank</option>
                        <option value="KSB">Krungsri Bank</option>
                        <option value="TMB">TMB Bank Public Company Limited</option>
                        <option value="KBank">Kasikorn Bank</option>
                        <option value="SCB">Siam Commercial Bank</option>
                        <option value="OUB">OUB Bank</option>
                        <option value="GSB">Government Savings Bank</option>
                    </select>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>วันที่ชำระเงิน</b></label>
                                <input type="date" class="form-control" name="txtDate" value="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>เวลาที่ชำระเงิน</b></label>
                                <input type="time" class="form-control" name="txtTime" value="" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <p><b>โปรดอ่านก่อนกดยืนยัน: ราคานี้เป็นราคามัดจำห้องพัก 50% จากราคาเต็ม อีก 50% ที่เหลือจะจ่ายเมื่อเข้าพักที่โรงแรม</b></p>
                    <br>
                    <!-- Button trigger modal -->
                    <button type="button" class="form-control btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        ยืนยันการชำระเงิน
                    </button>

                    <!-- Modal คือ ปุ่มกดยืนยันแล้วจะเด้งให้ยืนยันอีกที -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ยืนยันการชำระเงิน</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    โปรดอ่านก่อนกดยืนยัน: ราคานี้เป็นราคามัดจำห้องพัก 50% จากราคาเต็ม อีก 50% ที่เหลือจะจ่ายเมื่อเข้าพักที่โรงแรม
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                    <button class="btn btn-success" type="submit" name="button" value="confirm">ยืนยัน</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                </div>    
            </form>
        </body>
    </div>
    <!--- End container --->
</html>