<!--- Back-End --->
    <?php
    session_start();
    $errors = array();

    // ถ้าปุ่มสมัครไม่เป็นค่าว่าง
    if (isset($_POST['reg_user'])) {
        $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
        $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

        // ถ้าเหล่า if ตัวไหนเป็นค่าว่างแสดงข้อความเตือนหลังกดปุ่มสมัคร
        if (empty($fname)) {
            echo '
            <div class="alert alert-danger" role="alert">
            <i class="fa fa-times-circle"></i> กรุณากรอกชื่อของคุณ
            </div>';
        } else if (empty($lname)) {
            echo '
            <div class="alert alert-danger" role="alert">
            <i class="fa fa-times-circle"></i> กรุณากรอกนามสกุลของคุณ
            </div>';
        } else if (empty($tel)) {
            echo '
            <div class="alert alert-danger" role="alert">
            <i class="fa fa-times-circle"></i> กรุณากรอกเบอร์ของคุณ
            </div>';
        } else if (empty($username)) {
            echo '
            <div class="alert alert-danger" role="alert">
            <i class="fa fa-times-circle"></i> กรุณากรอกชื่อผู้ใช้
            </div>';
        } else if (empty($email)) {
            echo '
            <div class="alert alert-danger" role="alert">
            <i class="fa fa-times-circle"></i> กรุณากรอกอีเมล
            </div>';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '
            <div class="alert alert-danger" role="alert">
            <i class="fa fa-times-circle"></i> รูปแบบอีเมลไม่ถูกต้อง
            </div>';
        } else if (empty($password_1)) {
            echo '
            <div class="alert alert-danger" role="alert">
            <i class="fa fa-times-circle"></i> กรุณากรอกรหัสผ่าน
            </div>';
        } else if (empty($password_2)) {
            echo '
            <div class="alert alert-danger" role="alert">
            <i class="fa fa-times-circle"></i> กรุณายืนยันรหัสผ่าน
            </div>';
        } else if ($password_1 != $password_2) {
            echo '
            <div class="alert alert-danger" role="alert">
            <i class="fa fa-times-circle"></i> รหัสผ่านไม่ตรงกัน
            </div>';
        } else {
            $user_check_query = "SELECT * FROM user WHERE username = '$username' OR email = '$email' LIMIT 1";
            $query = mysqli_query($conn, $user_check_query);
            $result = mysqli_fetch_assoc($query);

            if ($result) { // มียูสหรือเมลในระบบแล้ว
                if ($result['username'] == $username) {
                    echo '
                <div class="alert alert-danger" role="alert">
                <i class="fa fa-times-circle"></i> มีชื่อผู้ใช้นี้ในระบบแล้ว
                </div>';
                } else if ($result['email'] == $email) {
                    echo '
                <div class="alert alert-danger" role="alert">
                <i class="fa fa-times-circle"></i> มีอีเมลนี้ในระบบแล้ว
                </div>';
                }
            }
            // ถ้าไม่มีข้อผิดพลาดในระบบ บันทึกค่าลง Database
            else {
                $_SESSION['username'] = $username;

                $password = md5($password_1);

                $sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
                mysqli_query($conn, $sql);

                $last_id = mysqli_insert_id($conn);
                $sql2 = "INSERT INTO members (Firstname, Lastname, Tel, userid) VALUES ('$fname', '$lname', '$tel','$last_id')";
                $result = mysqli_query($conn, $sql2);
                
                if ($result) {
                    echo '
            <div class="alert alert-success" role="alert">
            <i class="fa fa-check-circle"></i> สมัครเสร็จสิ้นและกำลังนำคุณเข้าสู่เว็บไซต์
            </div>' . "<meta http-equiv='refresh' content='2 ;url=?page=home'>";
                } else {
                    echo '
                <div class="alert alert-danger" role="alert">
                <i class="fa fa-times-circle"></i> มีบางอย่างผิดพลาด
                </div>';
                }
            }
        }
    }
    ?>
    <!--- End Back-End --->

    <!--- start container --->
    <div class="container">
    <!--- ส่วนของฟอร์มกรอกสมัคร --->
    <form method="POST">
        <div class="row justify-content-center align-items-center mb-4">
            <div class="col-sm-6 offset-sm-1">
            <br><br>
                <h1><b>สมัครสมาชิก</b></h1>
                <br>
                <form method="POST">
                    <div class="mb-3">
                        <label for="f_name" class="form-label"><i class="fa fa-user-circle"></i> ชื่อ</label>
                        <input type="text" class="form-control" name="f_name" />
                    </div>
                    <div class="mb-3">
                        <label for="l_name" class="form-label"><i class="fa fa-user-circle"></i> นามสกุล</label>
                        <input type="text" class="form-control" name="l_name" />
                    </div>
                    <div class="mb-3">
                        <label for="tel" class="form-label"><i class="fa fa-phone"></i> เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" name="tel" />
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label"><i class="fa fa-user"></i> ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" name="username" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="fa fa-envelope"></i> อีเมล</label>
                        <input type="email" class="form-control" name="email" />
                    </div>
                    <div class="mb-3">
                        <label for="password_1" class="form-label"><i class="fa fa-lock"></i> รหัสผ่าน</label>
                        <input type="password" class="form-control" name="password_1" />
                    </div>
                    <div class="mb-3">
                        <label for="password_2" class="form-label"><i class="fa fa-lock"></i> ยืนยันรหัสผ่าน</label>
                        <input type="password" class="form-control" name="password_2" />
                    </div>

                    <p>คุณมีบัญชีแล้วใช่ไหม? <a href="?page=login"><b>เข้าสู่ระบบ</a></b></p>
                    <button type="submit" name="reg_user" class="btn btn-primary" value="logout">สมัครสมาชิก</button>
                </form>
            </div>
        </div>
    </form>
    <!--- จบ ส่วนของฟอร์มกรอกสมัคร --->
</div>
<!--- End container --->