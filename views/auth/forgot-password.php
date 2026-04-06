<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-container">
    <div class="auth-box" style="max-width: 420px;">
        
        <div class="auth-header">
            <h2>🔑 Quên Mật Khẩu?</h2>
            <p class="auth-subtitle">Không lo lắng! Hãy nhập email để khôi phục tài khoản của bạn.</p>
        </div>

        <!-- hiển thị lỗi -->
        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $error): ?>
                    <p>❌ <?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- hiển thị thông báo thành công -->
        <?php if (!empty($success)): ?>
            <div class="success-message" style="background: #d4edda; color: #155724; border-color: #c3e6cb; margin-bottom: 20px; padding: 14px; border-radius: 8px;">
                ✅ <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <!-- form nhập email -->
        <form method="POST" class="auth-form">
            <div class="form-group">
                <label for="email">📧 Địa chỉ Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="example@email.com" required maxlength="100" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>

            <button type="submit" class="btn btn-primary">📮 Gửi Mã Xác Nhận</button>
        </form>

        <div style="text-align: center; margin-top: 20px;">
            <a href="web.php?action=login" style="color: var(--primary-color); text-decoration: none; font-size: 14px; font-weight: 600;">
                ← Quay lại Đăng nhập
            </a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>