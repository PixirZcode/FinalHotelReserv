<?php 
    @session_start();
    @session_destroy();
    echo '
    <div class="alert alert-success" role="alert">
    <i class="fa fa-check-circle"></i> <b> กำลังออกจากระบบ </b> 
    <div class="spinner-border spinner-border-sm text-primary" role="status">
    <span class="visually-hidden">Loading...</span>
    </div>
  </div>' . "<meta http-equiv='refresh' content='2 ;url=?page=login'>";
?>