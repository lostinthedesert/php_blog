CREATE DATABASE blog_db;
USE blog_db;

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO posts (title, content) VALUES 
('First Post', 'This is my first blog post!'),
('PHP is Awesome', 'Learning PHP for web development.');
