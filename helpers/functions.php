<?php
// kiểm tra đã đăng nhập chưa
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// kiểm tra có phải admin không
function isAdmin() {
    return isLoggedIn() && isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}


?>

