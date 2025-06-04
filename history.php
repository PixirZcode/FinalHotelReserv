<!--- Back-End --->
<?php
session_start();
$sql = "SELECT * FROM user JOIN book JOIN room JOIN payment ON user.User_ID = book.Book_user and book.Room_num = room.Room_ID and book.Books_ID = payment.Bk_id where username ='" . $_SESSION['username'] . "'";
$result = mysqli_query($conn, $sql);
?>
<!--- End Back-End --->

<div class="container">
    <br><br><br><br><br>
    <div class="homeheader">
        <h1><b>ประวัติการจอง</b></h1>
    </div>
    <br><br><br>
    <div class="row">
        <?php while ($row = $result->fetch_array()) { ?>
            <div class="col-md-3 mb-3">

                <div class="card card-body " style="width:100%; height:100% ">

                    <div class="card-body">

                        <img class="img card-img-top" src="images/<?php echo $row['Room_ID']; ?>.jpg"></img>
                        <br><br>
                        <h6><b><?php echo "หมายเลขใบเสร็จ: " . $row['Payment_ID']; ?></b></h6>

                        <h6><?php echo "ห้อง: " . $row['Room_ID']; ?></h6>

                        <h6><?php echo "เตียง: " . $row['TypeR']; ?></h6>

                        <h6><?php echo "ราคา: " . $row['Price']; ?>  บาท <h6 style="color:red">*นี่เป็นเพียงราคามัดจำห้องพัก 50% (เท่านั้น)</h6> </h6>

                        <h6><?php echo "เช็คอิน: " . $row['Check_in']; ?> </h6>

                        <h6><?php echo "เช็คเอาท์: " . $row['Check_out']; ?> </h6>

                    </div>
                </div>

            </div>
        <?php } ?>
    </div>
</div>    