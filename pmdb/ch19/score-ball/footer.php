<?php @session_start(); ?>
<footer class="text-center mt-5 fixed-bottom text-white bg-secondary py-1">
      &copy; developerthai.com&nbsp;&nbsp;&nbsp;
<?php
if (isset($_SESSION['admin'])) {
      echo <<<HTML
      <div class="dropup d-inline">
            <button class="btn btn-info btn-sm dropdown-toggle small" type="button" data-toggle="dropdown">admin</button>
            <div class="dropdown-menu">
                  <a class="dropdown-item" href="admin-update-score.php">อัปเดตผลการแข่งขัน</a>
                  <a class="dropdown-item" href="admin-add-match.php">เพิ่มโปรแกรมแข่งขัน</a>
                  <a class="dropdown-item" href="admin-add-team.php">เพิ่มทีมใหม่</a>
                  <a class="dropdown-item" href="admin-signout.php">ออกจากระบบ</a>
            </div>
      </div>                  
      HTML;
} else {
      echo '[<a href="admin-signin.php" class="text-warning">admin</a>]';
}
?>
</footer>
<br><br><br><br><br>
