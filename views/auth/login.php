<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-container">
    <div class="auth-box">

        <div class="auth-header">
            <h2>Đăng Nhập</h2>
            <p class="auth-subtitle">Chào mừng bạn đến với Cinema Central</p>
        </div>

        <!-- thông báo thành công -->
        <?php if (isset($_GET['message'])): ?>
            <div class="success-message">✅ <?php echo htmlspecialchars($_GET['message']); ?></div>
        <?php endif; ?>

        <!-- hiển thị lỗi -->
        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $error): ?>
                    <p>❌ <?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- form đăng nhập -->
        <form method="POST" class="auth-form">

            <!-- nhập email -->
            <div class="form-group">
                <label for="email">📧 Email hoặc Số điện thoại</label>
                <input type="email" id="email" name="email" placeholder="example@gmail.com" required class="form-control">
            </div>

            <!-- nhập mật khẩu -->
            <div class="form-group">
                <label for="password">🔐 Mật khẩu</label>
                <div class="password-input-container">
                    <input type="password" id="password" name="password" placeholder="••••••••" required class="form-control" maxlength="50">
                    
                    <!-- nút hiện/ẩn mật khẩu -->
                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                        👁️
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">🔓 Đăng Nhập</button>
        </form>

        <!-- link phụ -->
        <div class="auth-links">
            <a href="web.php?action=forgot-password" class="link-item">❓ Quên mật khẩu?</a>
            <span class="divider">•</span>
            <a href="web.php?action=register" class="link-item">📝 Đăng ký ngay</a>
        </div>

        <!-- login bằng mạng xã hội -->
        <div class="social-divider">Hoặc đăng nhập với</div>

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