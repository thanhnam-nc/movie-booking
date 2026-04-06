<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="profile-container">

    <div class="profile-header">
        <h2>Cập nhật Thông Tin Cá Nhân</h2>
    </div>

    <!-- thông báo thành công -->
    <?php if (isset($_GET['message'])): ?>
        <div class="success-message"><?php echo htmlspecialchars($_GET['message']); ?></div>
    <?php endif; ?>

    <!-- hiển thị lỗi -->
    <?php if (!empty($errors)): ?>
        <div class="error-message">
            <?php foreach ($errors as $error): ?>
                <p>❌ <?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="profile-content">

        <!-- sidebar -->
        <aside class="profile-sidebar">
            <div class="user-avatar">
                <!-- chữ cái đầu -->
                <span class="avatar-initial"><?php echo strtoupper(substr($user['full_name'], 0, 1)); ?></span>
            </div>

            <div class="user-info-sidebar">
                <h3><?php echo htmlspecialchars($user['full_name']); ?></h3>
                <p>Thành viên VIP</p>
            </div>

            <!-- menu -->
            <nav class="profile-menu">
                <a href="web.php?action=profile" class="menu-item active">
                    <span>👤</span> Thông tin cá nhân
                </a>
                <a href="web.php?action=change-password" class="menu-item">
                    <span>🔐</span> Đổi mật khẩu
                </a>
                <a href="web.php?action=logout" class="menu-item logout">
                    <span>🚪</span> Đăng xuất
                </a>
            </nav>
        </aside>

        <!-- nội dung chính -->
        <div class="profile-main">
            <div class="profile-card">

                <h3>Cập nhật thông tin cá nhân</h3>
                <p class="card-subtitle">Quản lý và cập nhật thông tin cá nhân của bạn</p>

                <!-- form -->
                <form method="POST" class="profile-form">

                    <!-- hàng 1 -->
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="full_name">Họ và Tên</label>
                            <input type="text" id="full_name" name="full_name" class="form-control" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>
                    </div>

                    <!-- hàng 2 -->
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
                        </div>

                        <div class="form-group">
                            <label for="birthday">Ngày sinh</label>
                            <input type="date" id="birthday" name="birthday" class="form-control" value="<?php echo htmlspecialchars($user['birthday'] ?? ''); ?>">
                        </div>
                    </div>

                    <!-- địa chỉ -->
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" id="address" name="address" class="form-control" value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                        <a href="web.php?action=profile" class="btn btn-secondary">Hủy</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>