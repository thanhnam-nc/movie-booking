<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php if (empty($searchQuery)): ?>
    <div class="home-hero">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <div class="hero-info">
                <span class="eyebrow hero-eyebrow">PHIM ĐANG HOT</span>
                <h1>Nhà Bà Nữ</h1>
                <p>Câu chuyện xoay quanh gia đình bà Nữ gồm ba thế hệ sống cùng nhau trong một ngôi nhà. Bà Nữ một tay cáng đáng mọi sự, nổi tiếng với quán bánh canh cua và cũng khét tiếng với việc kiểm soát cuộc sống của tất cả mọi người, từ con gái đến con rể. Mọi chuyện diễn ra bình thường cho đến khi cô con gái út si mê anh chàng điển trai xuất thân từ một gia đình giàu có. Truyện phim khắc họa mối quan hệ phức tạp, đa chiều xảy ra với các thành viên trong gia đình. Câu tagline (thông điệp) chính “Ai cũng có lỗi, nhưng ai cũng nghĩ mình là… nạn nhân” chứa nhiều ẩn ý về nội dung bộ phim muốn gửi gắm.</p>
                <div class="hero-actions">
                    <a href="#now-showing" class="btn btn-primary">Đặt vé ngay</a>
                    <button type="button" class="btn btn-secondary btn-secondary--light open-trailer" data-trailer="<?php echo htmlspecialchars($movies[0]['trailer_url'] ?? ''); ?>">Xem trailer</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="trailer-modal" id="trailerModal" aria-hidden="true">
    <div class="trailer-modal-backdrop" id="trailerBackdrop"></div>
    <div class="trailer-modal-content" role="dialog" aria-modal="true" aria-labelledby="trailerTitle">
        <div class="trailer-modal-header">
            <h2 id="trailerTitle">Xem trailer</h2>
            <button type="button" class="trailer-close" id="trailerClose" aria-label="Đóng">×</button>
        </div>
        <div class="trailer-video">
            <iframe id="trailerIframe" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
    </div>
</div>

<?php if (!empty($searchQuery)): ?>
    <div class="search-results-banner">
        <div class="container">
            <p>Kết quả tìm kiếm cho <strong>"<?php echo htmlspecialchars($searchQuery); ?>"</strong></p>
        </div>
    </div>
<?php endif; ?>

<div class="page-section" id="now-showing">
    <div class="container">
        <div class="section-header section-spacer">
            <div class="section-title">
                <span class="eyebrow">PHIM ĐANG CHIẾU</span>
                <h2>Phim đang chiếu</h2>
            </div>
        </div>

        <?php if (!empty($movies)): ?>
            <div class="movie-grid">
                <?php foreach ($movies as $movie):
                    $poster = trim($movie['poster_url'] ?? '');
                    if ($poster === '') {
                        $poster = 'assets/images/default-movie.jpg';
                    } elseif (!preg_match('/^(?:https?:\/\/|\/)/', $poster)) {
                        $poster = 'assets/images/' . ltrim($poster, '/');
                    }
                    $posterUrl = htmlspecialchars($poster);
                ?>
                    <article class="movie-card">
                        <div class="movie-poster">
                            <img src="<?php echo $posterUrl; ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
                            <div class="movie-poster-overlay"></div>
                            <div class="movie-poster-badge">
                                <span><?php echo htmlspecialchars($movie['genre']); ?></span>
                            </div>
                        </div>
                        <div class="movie-content">
                            <h2><?php echo htmlspecialchars($movie['title']); ?></h2>
                            <p class="movie-meta"><?php echo htmlspecialchars($movie['genre']); ?> • <?php echo intval($movie['duration']); ?> phút</p>
                            <p class="movie-description"><?php echo htmlspecialchars(mb_substr($movie['description'] ?? '', 0, 120)); ?><?php echo strlen($movie['description'] ?? '') > 120 ? '...' : ''; ?></p>
                            <div class="movie-actions">
                                <a href="web.php?action=movie&id=<?php echo $movie['movie_id']; ?>" class="btn btn-secondary">Đặt vé</a>
                                <button type="button" class="btn btn-secondary btn-secondary--light open-trailer" data-trailer="<?php echo htmlspecialchars($movie['trailer_url'] ?? ''); ?>">Xem trailer</button>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <p>Không có phim nào đang chiếu vào lúc này. Vui lòng quay lại sau.</p>
            </div>
        <?php endif; ?>

        <div class="section-header section-spacer" id="coming-soon">
            <div class="section-title">
                <span class="eyebrow">PHIM SẮP CHIẾU</span>
                <h2>Phim sắp chiếu</h2>
            </div>
        </div>
        <div class="coming-soon-grid">
            <?php if (!empty($comingSoon)): ?>
                <?php foreach ($comingSoon as $movie):
                    $poster = trim($movie['poster_url'] ?? '');
                    if ($poster === '') {
                        $poster = 'assets/images/default-movie.jpg';
                    } elseif (!preg_match('/^(?:https?:\/\/|\/)/', $poster)) {
                        $poster = 'assets/images/' . ltrim($poster, '/');
                    }
                    $posterUrl = htmlspecialchars($poster);
                    $releaseDate = strtotime($movie['release_date'] ?? '');
                    if ($releaseDate) {
                        $releaseLabel = sprintf('%02d Tháng %d', date('d', $releaseDate), date('n', $releaseDate));
                    } else {
                        $releaseLabel = 'Sắp chiếu';
                    }
                ?>
                    <article class="coming-soon-card">
                        <div class="coming-soon-poster">
                            <img src="<?php echo $posterUrl; ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
                            <div class="coming-soon-overlay"></div>
                            <span class="coming-soon-date"><?php echo $releaseLabel; ?></span>
                            <div class="coming-soon-caption">
                                <h3><?php echo htmlspecialchars($movie['title']); ?></h3>
                                <p class="coming-soon-description"><?php echo htmlspecialchars(substr($movie['description'] ?? '', 0, 100)); ?>...</p>
                                <button type="button" class="btn btn-secondary btn-secondary--light open-trailer coming-soon-trailer" data-trailer="<?php echo htmlspecialchars($movie['trailer_url'] ?? ''); ?>">Xem trailer</button>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <p>Hiện chưa có phim sắp chiếu. Vui lòng quay lại sau.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="page-section theaters-section" id="theaters">
        <div class="container">
            <div class="section-header section-spacer">
                <div class="section-title">
                    <span class="eyebrow">RẠP</span>
                    <h2>Hệ thống rạp và phòng chiếu</h2>
                </div>
            </div>

            <?php if (!empty($theaters)): ?>
                <div class="theater-grid">
                    <?php foreach ($theaters as $cinemaName => $rooms): ?>
                        <article class="theater-card">
                            <div class="theater-card-header">
                                <span class="cinema-icon">📍</span>
                                <h3><?php echo htmlspecialchars($cinemaName); ?></h3>
                            </div>
                            <ul class="room-list">
                                <?php foreach ($rooms as $room): ?>
                                    <li><?php echo htmlspecialchars($room['hall']); ?> <span class="room-capacity">(Sức chứa <?php echo number_format($room['capacity'], 0, ',', '.'); ?>)</span></li>
                                <?php endforeach; ?>
                            </ul>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <p>Hiện chưa có thông tin rạp và phòng chiếu.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="page-section promotions-section" id="promotions">
        <div class="container">
            <div class="section-header section-spacer">
                <div class="section-title">
                    <span class="eyebrow">KHUYẾN MÃI</span>
                    <h2>Khuyến mãi đang áp dụng</h2>
                </div>
            </div>

            <?php if (!empty($activePromotions)): ?>
                <div class="promo-grid">
                    <?php foreach ($activePromotions as $promo): ?>
                        <?php
                            $seatTypes = [];
                            if (!empty($promo['applicable_seat_types'])) {
                                $types = json_decode($promo['applicable_seat_types'], true);
                                if (is_array($types)) {
                                    $seatTypes = $types;
                                }
                            }
                            $rules = [];
                            if (!empty($promo['min_tickets'])) {
                                $rules[] = 'Tối thiểu ' . intval($promo['min_tickets']) . ' vé';
                            }
                            if (!empty($promo['min_amount'])) {
                                $rules[] = 'Đơn từ ' . number_format($promo['min_amount'], 0, ',', '.') . '₫';
                            }
                            if (!empty($seatTypes)) {
                                $rules[] = 'Áp dụng ghế: ' . implode(', ', $seatTypes);
                            }
                            $discountLabel = $promo['discount_type'] === 'percent' ? 'Giảm ' . intval($promo['discount_value']) . '%' : 'Giảm ' . number_format($promo['discount_value'], 0, ',', '.') . '₫';
                        ?>
                        <article class="promo-card">
                            <div class="promo-card-header">
                                <span class="promo-code"><?php echo htmlspecialchars($promo['promo_code']); ?></span>
                                <strong><?php echo htmlspecialchars($discountLabel); ?></strong>
                            </div>
                            <p class="promo-description"><?php echo htmlspecialchars($promo['description']); ?></p>
                            <?php if (!empty($rules)): ?>
                                <ul class="promo-rules">
                                    <?php foreach ($rules as $rule): ?>
                                        <li><?php echo htmlspecialchars($rule); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <div class="promo-apply">
                                <p><strong>Cách áp dụng:</strong> Nhập mã <code><?php echo htmlspecialchars($promo['promo_code']); ?></code> vào ô "Nhập mã ưu đãi" khi đặt vé, sau đó nhấn "Áp dụng".</p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <p>Hiện chưa có chương trình khuyến mãi nào.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const trailerModal = document.getElementById('trailerModal');
        const trailerIframe = document.getElementById('trailerIframe');
        const trailerClose = document.getElementById('trailerClose');
        const trailerBackdrop = document.getElementById('trailerBackdrop');

        function getAutoplayUrl(url) {
            if (!url) return '';
            return url.includes('?') ? url + '&autoplay=1' : url + '?autoplay=1';
        }

        function openTrailer(trailerUrl) {
            if (!trailerUrl) {
                alert('Trailer hiện chưa có sẵn.');
                return;
            }
            trailerIframe.src = getAutoplayUrl(trailerUrl);
            trailerModal.classList.add('open');
            trailerModal.setAttribute('aria-hidden', 'false');
        }

        function closeTrailer() {
            trailerIframe.src = '';
            trailerModal.classList.remove('open');
            trailerModal.setAttribute('aria-hidden', 'true');
        }

        document.querySelectorAll('.open-trailer').forEach(function(button) {
            button.addEventListener('click', function() {
                const trailerUrl = this.getAttribute('data-trailer');
                console.log('Trailer URL:', trailerUrl);
                openTrailer(trailerUrl);
            });
        });

        trailerClose.addEventListener('click', closeTrailer);
        trailerBackdrop.addEventListener('click', closeTrailer);
        window.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && trailerModal.classList.contains('open')) {
                closeTrailer();
            }
        });
    </script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
