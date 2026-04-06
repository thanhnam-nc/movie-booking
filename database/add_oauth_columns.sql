-- Thêm các cột để hỗ trợ OAuth vào bảng Users
ALTER TABLE Users ADD COLUMN IF NOT EXISTS oauth_provider VARCHAR(50) NULL;
ALTER TABLE Users ADD COLUMN IF NOT EXISTS oauth_id VARCHAR(255) NULL;
ALTER TABLE Users ADD COLUMN IF NOT EXISTS avatar_url VARCHAR(255) NULL;
ALTER TABLE Users ADD COLUMN IF NOT EXISTS phone VARCHAR(20);
ALTER TABLE Users ADD COLUMN IF NOT EXISTS birthday DATE;
ALTER TABLE Users ADD COLUMN IF NOT EXISTS address VARCHAR(255);

-- Tạo UNIQUE constraint cho oauth_provider và oauth_id
ALTER TABLE Users ADD UNIQUE KEY IF NOT EXISTS unique_oauth (oauth_provider, oauth_id);
