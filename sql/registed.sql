CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(191) NOT NULL,
    phone VARCHAR(191),
    email VARCHAR(191) NOT NULL,
    password VARCHAR(191) NOT NULL,
    admin INT(1) DEFAULT(0),
    verify_token VARCHAR(191),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
ALTER TABLE users ADD UNIQUE KEY users_email_unique (email);

