

<div class="container">
    <!--- Back-End --->
    <?php
    session_start();
    $sql = "SELECT * FROM user JOIN members ON user.User_ID = members.Member_ID WHERE username ='" . $_SESSION['username'] . "'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);


    if (isset($_POST['editprofile'])) {
        $fname =  mysqli_real_escape_string($conn, $_POST['fname']);
        $lname =  mysqli_real_escape_string($conn, $_POST['lname']);
        $tel =  mysqli_real_escape_string($conn, $_POST['tel']);
        $email =  mysqli_real_escape_string($conn, $_POST['email']);
        
        if (empty($tel) || empty($email) || empty($fname) || empty($lname)) {
            echo '
            <div class="alert alert-danger" role="alert">
            <i class="fa fa-check-circle"></i> แก้ไขไม่สำเร็จ
            </div>';
        } else {
            $sql = "UPDATE user JOIN members ON user.User_ID = members.Member_ID SET Firstname = '$fname', Lastname = '$lname', Tel = '$tel', email = '$email' WHERE username ='" . $_SESSION['username'] . "'";
            mysqli_query($conn, $sql);
            echo '
                    <div class="alert alert-success" role="alert">
                    <i class="fa fa-check-circle"></i> แก้ไขสำเร็จ
                    </div>' . "<meta http-equiv='refresh' content='2 ;url=?page=home'>";
        }
    }else if(isset($_POST['deluser'])){
        $sql = "DELETE FROM user  WHERE User_ID ='" . $row['User_ID'] . "'";
        mysqli_query($conn, $sql);
        $sql = "DELETE FROM members  WHERE User_ID ='" . $row['Member_ID'] . "'";
        mysqli_query($conn, $sql);
        @session_start();
        @session_destroy();
        echo '
                    <div class="alert alert-success" role="alert">
                    <i class="fa fa-check-circle"></i> ลบบัญชีสำเร็จ
                    </div>' . "<meta http-equiv='refresh' content='2 ;url=?page=welcomepage'>";
    }
    ?>
    <!--- End Back-End --->
    <div class="row justify-content-center align-items-center mb-4">
        <div class="col-sm-6 offset-sm-1">

         

                <br><br><br><br><br><br>
                <div class="homeheader">
                    <h2><b>ข้อมูลส่วนตัว</b></h2>
                </div>
                <br>
                               
                <h5><i class="fa fa-user-circle"></i><b> ชื่อ :</b> <?php echo $row['Firstname']; ?></h5>
                <h5><i class="fa fa-user-circle"></i><b> นามสกุล :</b> <?php echo $row['Lastname']; ?></h5>
                <h5><i class="fa fa-phone"></i><b> เบอร์โทร :</b> <?php echo $row['Tel']; ?></h5>
                <h5><i class="fa fa-envelope"></i><b> อีเมล :</b> <?php echo $row['email']; ?></h5>
                <br>
                <div class="homeheader">
                    <h3><b> แก้ไขข้อมูลส่วนตัว </b></h3>
                </div>
                <br>
                <form method="POST">
                <div class="mb-3">
                        <label for="fname" class="form-label"><i class="fa fa-user-circle"></i> ชื่อ</label>
                        <input type="text" class="form-control" name="fname"/>
                    </div>
                    <div class="mb-3">
                        <label for="lname" class="form-label"><i class="fa fa-user-circle"></i> นามสกุล</label>
                        <input type="text" class="form-control" name="lname"/>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="fa fa-envelope"></i> อีเมล</label>
                        <input type="email" class="form-control" name="email"/>
                    </div>
                    <div class="mb-3">
                        <label for="tel" class="form-label"><i class="fa fa-phone"></i> เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" maxlength='10' name="tel"/>
                    </div>

                    <!-- Button trigger modal -->
                    <button type="button" class="form-control btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        แก้ไขข้อมูลส่วนตัว
                    </button>
                    <!-- End Button trigger modal -->
                    
                    <!-- Modal คือ ปุ่มที่กดแล้วจะเด้งให้กดยืนยันอีกรอบ -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ท่านต้องการแก้ไขข้อมูลส่วนตัวหรือไม่</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                    <button type="submit" name="editprofile" class="btn btn-success" value="home">ยืนยัน</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                    <br>

                    <!-- Button trigger modal -->
                    <button type="button" class="form-control btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                        ลบบัญชีนี้
                    </button>
                    <!-- End Button trigger modal -->

                    <!-- Modal คือ ปุ่มที่กดแล้วจะเด้งให้กดยืนยันอีกรอบ -->
                    <form method="POST">
                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">ท่านต้องการลบบัญชีนี้หรือไม่</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                        <button type="submit" name="deluser" class="btn btn-success" value="welcomepage">ยืนยัน</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- End Modal -->
                </form>
        </div>
    </div>

</div>
