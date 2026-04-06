<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="page-section success-page">
    <div class="container">
        <div class="success-panel card-panel">
            <div class="success-header">
                <div class="success-icon">✓</div>
                <div>
                    <h1>Đặt vé thành công!</h1>
                    <p>Cảm ơn bạn đã đặt vé. Thông tin vé đã được gửi qua email.</p>
                </div>
            </div>

            <div class="success-details">
                <div class="success-box success-detail-box">
                    <div class="success-ticket-header">
                        <div class="success-poster" style="background-image:url('<?php echo htmlspecialchars(preg_match('/^(?:https?:\/\/|\/)/', trim($tickets[0]['poster_url'] ?? '')) ? trim($tickets[0]['poster_url'] ?? '') : 'assets/images/' . ltrim(trim($tickets[0]['poster_url'] ?? ''), '/')); ?>')"></div>
                        <div class="success-ticket-info">
                            <h2>Chi tiết vé xem phim</h2>
                            <div class="status-badge">Đã thanh toán</div>
                        </div>
                    </div>
                    <div class="summary-row"><span>Mã vé</span><strong><?php echo htmlspecialchars($order['order_code']); ?></strong></div>
                    <div class="summary-row"><span>Phim</span><strong><?php echo htmlspecialchars($tickets[0]['title'] ?? ''); ?></strong></div>
                    <div class="summary-row"><span>Suất chiếu</span><strong><?php echo htmlspecialchars($tickets[0]['show_date'] ?? ''); ?> <?php echo htmlspecialchars(substr($tickets[0]['start_time'] ?? '', 0, 5)); ?></strong></div>
                    <div class="summary-row"><span>Ghế</span><strong><?php echo htmlspecialchars(implode(', ', array_map(function($ticket) { return $ticket['seat_row'] . $ticket['seat_number']; }, $tickets))); ?></strong></div>
                    <div class="summary-row"><span>Hình thức thanh toán</span><strong>Ví điện tử MoMo</strong></div>
                    <div class="summary-row total"><span>Tổng thanh toán</span><strong><?php echo number_format($order['final_amount'], 0, ',', '.'); ?>₫</strong></div>
                </div>

                <div class="success-box qr-box">
                    <div class="qr-box-header">
                        <h2>Mã QR vào rạp</h2>
                    </div>
                    <div class="qr-card">
                        <img src="assets/images/qr.jpg" alt="Mã QR vào rạp" class="success-qr-image">
                    </div>
                    <p>Xuất trình mã QR này tại quầy vé hoặc máy soát vé khi vào rạp.</p>
                </div>
            </div>

            <div class="success-actions">
                <a href="web.php?action=history" class="btn btn-primary btn-full">Xem lịch sử đặt vé</a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>