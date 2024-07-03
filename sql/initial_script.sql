CREATE DATABASE vulnerable_app;
CREATE USER webapp_user WITH PASSWORD 'insecure_password';
GRANT ALL PRIVILEGES ON DATABASE vulnerable_app TO webapp_user;

GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO webapp_user;
GRANT USAGE, SELECT ON ALL SEQUENCES IN SCHEMA public TO webapp_user;

CREATE TABLE users (
                       id SERIAL PRIMARY KEY,
                       username VARCHAR(50) UNIQUE NOT NULL,
                       password VARCHAR(255) NOT NULL,
                       email VARCHAR(100) UNIQUE NOT NULL,
                       role VARCHAR(20) NOT NULL DEFAULT 'user'
);

CREATE TABLE posts (
                       id SERIAL PRIMARY KEY,
                       title VARCHAR(255) NOT NULL,
                       content TEXT NOT NULL,
                       author_id INTEGER REFERENCES users(id),
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE files (
                       id SERIAL PRIMARY KEY,
                       filename VARCHAR(255) NOT NULL,
                       path VARCHAR(255) NOT NULL,
                       uploaded_by INTEGER REFERENCES users(id),
                       uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);