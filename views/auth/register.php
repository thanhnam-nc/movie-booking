<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-container">
    <div class="auth-box register-box">

        <div class="auth-header">
            <h2>Đăng Ký Tài Khoản</h2>
            <p class="auth-subtitle">Tạo tài khoản để bắt đầu đặt vé xem phim</p>
        </div>

        <!-- hiển thị lỗi -->
        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $error): ?>
                    <p>❌ <?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- form đăng ký -->
        <form method="POST" class="auth-form">

            <!-- họ tên -->
            <div class="form-group">
                <label for="full_name">👤 Họ và Tên</label>
                <input type="text" id="full_name" name="full_name" placeholder="Nguyễn Văn A" required class="form-control" value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>">
            </div>

            <!-- email -->
            <div class="form-group">
                <label for="email">📧 Email</label>
                <input type="email" id="email" name="email" placeholder="email@example.com" required class="form-control" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>

            <!-- số điện thoại -->
            <div class="form-group">
                <label for="phone">📱 Số điện thoại</label>
                <input type="tel" id="phone" name="phone" placeholder="0901234567" required class="form-control" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
            </div>

            <!-- ngày sinh -->
            <div class="form-group">
                <label for="birthday">📅 Ngày sinh</label>
                <input type="date" id="birthday" name="birthday" class="form-control" value="<?php echo htmlspecialchars($_POST['birthday'] ?? ''); ?>">
            </div>

            <!-- địa chỉ -->
            <div class="form-group">
                <label for="address">📍 Địa chỉ</label>
                <input type="text" id="address" name="address" placeholder="Quận 1, TP. HCM" class="form-control" value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>">
            </div>

            <div class="form-row">

                <!-- mật khẩu -->
                <div class="form-group">
                    <label for="password">🔐 Mật khẩu</label>
                    <div class="password-input-container">
                        <input type="password" id="password" name="password" placeholder="••••••••" required class="form-control" maxlength="50">
                        
                        <!-- nút hiện/ẩn -->
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            👁️
                        </button>
                    </div>

                    <!-- yêu cầu mật khẩu -->
                    <div class="password-requirements">
                        <small style="color: #666; font-size: 12px; line-height: 1.4;">
                            Mật khẩu phải có:<br>
                            • 8-50 ký tự<br>
                            • Ít nhất 1 chữ hoa, 1 chữ thường<br>
                            • Ít nhất 1 số và 1 ký tự đặc biệt
                        </small>
                    </div>
                </div>

                <!-- xác nhận mật khẩu -->
                <div class="form-group">
                    <label for="confirm_password">🔒 Xác nhận mật khẩu</label>
                    <div class="password-input-container">
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" required class="form-control" maxlength="50">
                        <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
                            👁️
                        </button>
                    </div>
                </div>
            </div>

            <!-- điều khoản -->
            <div class="form-group terms">
                <label>
                    <input type="checkbox" required> 
                    Tôi đồng ý với <a href="#">Điều khoản sử dụng</a> & <a href="#">Chính sách bảo mật</a>
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-lg">✅ Đăng Ký Ngay</button>
        </form>

        <!-- link login -->
        <div class="auth-links">
            <p>Đã có tài khoản? <a href="web.php?action=login" class="link-item">🔓 Đăng nhập</a></p>
        </div>

        <!-- đăng ký bằng mạng xã hội -->
        <div class="social-divider">Hoặc đăng ký với</div>

        <div class="social-login">
            <div class="social-buttons">
                <a href="web.php?action=login-google" class="social-btn google-btn">
                    <!-- icon Google -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    Google
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// hiện / ẩn mật khẩu
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const button = input.nextElementSibling;

    if (input.type === 'password') {
        input.type = 'text';
        button.textContent = '🙈';
    } else {
        input.type = 'password';
        button.textContent = '👁️';
    }
}
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>