CREATE TABLE login(
    username char(100) UNIQUE,
    password varchar(10) UNIQUE,
    isvalid int
);

CREATE TABLE users (
    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    email VARCHAR(100) UNIQUE DEFAULT 'not provided',
    phone VARCHAR(15) DEFAULT 'not provided',
    address VARCHAR(255) DEFAULT 'not provided',
    linkedin VARCHAR(255) DEFAULT 'not provided',
    github VARCHAR(255) DEFAULT 'not provided',
    website VARCHAR(255) DEFAULT 'not provided',
    bio VARCHAR(255) DEFAULT 'not provided',
    profile_photo VARCHAR(255) DEFAULT 'No Profile Picture Facebook Icon.jpeg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_name VARCHAR(200)
);

CREATE TABLE education (
    edu_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    institution VARCHAR(100),
    degree VARCHAR(100),
    start_year YEAR,
    end_year YEAR,
    cgpa VARCHAR(10),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE certifications (
    cert_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    cert_title VARCHAR(150),
    issuer VARCHAR(100),
    issue_date DATE,
    cert_file_path VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE projects (
    project_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(150),
    description TEXT,
    technologies VARCHAR(255),
    github_link VARCHAR(255),
    live_demo_link VARCHAR(255),
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE resumes (
    resume_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    file_path VARCHAR(255),
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
