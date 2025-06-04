<!--- Back-End --->
<!--- start container --->
<div class="container">

    <?php
    if (isset($_POST['btn'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (empty($username) || empty($password)) {
            echo '
            <div class="alert alert-danger" role="alert">
            <i class="fa fa-times-circle"></i> กรุณาใส่ชื่อผู้ใช้และรหัสผ่าน
            </div>';
        } else if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password' ";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                $_SESSION['username'] = $username;
                echo '
            <div class="alert alert-success" role="alert">
            <i class="fa fa-check-circle"></i> <b> กำลังเข้าสู่ระบบ </b> 
            <div class="spinner-border spinner-border-sm text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
            </div>
            </div>' . "<meta http-equiv='refresh' content='2 ;url=?page=home'>";
            } else {
                echo '
            <div class="alert alert-danger" role="alert">
            <i class="fa fa-times-circle"></i> ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง
            </div>';
            }
        }
    }
    ?>
<!--- End Back-End --->

    <!--- row --->
    <div class="row justify-content-center align-items-center mb-4">
        <div class="col-sm-6 offset-sm-1">
            <form method="POST">
                <br><br><br><br><br><br><br><br><br><br>
                <h1><b>เข้าสู่ระบบ</b></h1>
                <br>

                <label for="username" class="form-label"> ชื่อผู้ใช้</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="กรอกชื่อผู้ใช้" aria-label="Username" aria-describedby="basic-addon1" name="username">
                </div>

                       
                <label for="password" class="form-label"> รหัสผ่าน</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" placeholder="กรอกรหัสผ่าน" aria-label="password" aria-describedby="basic-addon1" name="password">
                </div>

                
                <p>คุณยังไม่มีบัญชีใช่ไหม ?<a href="?page=register"><b> สมัครสมาชิก </b></a></p>
                <button type="submit" name="btn" class="btn btn-primary" value="login">ล็อกอิน</button>
            </form>
        </div>
    </div>
    <!--- End row --->
</div>
<!--- End container --->