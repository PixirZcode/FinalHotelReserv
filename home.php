<!-- Not logged in -->
<?php
    if(!isset($_SESSION['username'])){
        include('welcomepage.php');
    }else{
?>

<!--- Back-End --->
<?php
$sql = "SELECT * FROM room WHERE Status='0'";
$result = mysqli_query($conn, $sql);
?>
<!--- End Back-End --->

<!--- start container --->
<div class="container">

    <form method="POST" action="?page=payment">
        <!--- row date --->
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating" ><h3><b>เช็คอิน</b></h3></label>
                    <input type="date" class="form-control" name="Check_in" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating"><b><h3>เช็คเอาท์</b></h3></label>
                    <input type="date" class="form-control" name="Check_out" required>
                </div>
            </div>
        </div>
        <!--- end row date --->

        <!-- lopp room -->
        <div class="row">
            <?php while ($row = $result->fetch_array()) { ?>

                <div class="col-md-3 mb-3">

                    <div class="card card-body " style="width:100%; height:100% ">

                        <div class="card-body">

                            <img class="img card-img-top" src="images/<?php echo $row['Room_ID']; ?>.jpg"></img>
                            <br><br>
                            <h6><b class="card-title"><?php echo "ห้อง: " . $row['Room_ID']; ?></b></h6>

                            <h6><?php echo "เตียง: " . $row['TypeR']; ?></h6>

                            <h6><?php echo "ราคา: " . $row['Price'] . " บาท"; ?> </h6>

                            <button type="submit" name="b" value="<?php echo $row['Room_ID']; ?>" class="btn btn-success">จอง</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!--- End loop room --->
    </form>
</div>
<!--- End container --->
<?php } ?>