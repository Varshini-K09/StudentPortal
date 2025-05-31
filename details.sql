--login table
INSERT INTO login (username,password,isvalid)
VALUES

('nisha123','nisha@23',1),
('alice_j','alice@24',1),
('bob_s','bob@234',1);

-- users table
INSERT INTO users (user_id, full_name, email, phone, address, linkedin, github, website, bio, profile_photo, created_at, user_name)
VALUES

(1, 'Nisha Rathi', 'nisha.rathi@gmail.com', '+91 90123 45678', '123 MG Road, Chennai, Tamil Nadu, India',
 'linkedin.com/in/nisharathi', 'github.com/nishacodes', 'https://nisharathi.dev',
 'Passionate computer science student who enjoys web development and open-source contributions.',
 'Screenshot from 2025-05-26 13-16-06.png', '2025-05-26 13:31:25', 'nisha123'),

(2, 'Alice Johnson', 'alice.johnson@example.com', '9876543210', '123 Maple Street, NY',
 'https://linkedin.com/in/alicejohnson', 'https://github.com/alicej', 'https://alice.dev',
 'Software engineer passionate about AI.', 'alice.jpg', DEFAULT, 'alice_j'),

(3, 'Bob Smith', 'bob.smith@example.com', '9123456780', '456 Oak Avenue, CA',
 'https://linkedin.com/in/bobsmith', 'https://github.com/bsmith', 'https://bobsmith.dev',
 'Full-stack developer and tech blogger.', 'bob.jpg', DEFAULT, 'bob_s');

--education table
INSERT INTO education (user_id, institution, degree, start_year, end_year, cgpa)
VALUES
(1, 'VIT Chennai', 'B.Tech Computer Science', 2021, 2025, '8.7'),
(1, 'Sunrise Public School', 'Higher Secondary (CBSE)', 2019, 2021, '9.3'),
(2, 'MIT', 'B.Tech Computer Science', 2016, 2020, '3.9'),
(3, 'Stanford University', 'B.Sc Software Engineering', 2017, 2021, '3.7');

--certification table
INSERT INTO certifications (user_id, cert_title, issuer, issue_date, cert_file_path)
VALUES
(1, 'Responsive Web Design', 'freeCodeCamp', '2023-06-10', 'certs/nisha_webdesign.pdf'),
(2, 'AWS Certified Solutions Architect', 'Amazon', '2022-06-15', 'certs/aws_alice.pdf'),
(3, 'Google Data Analytics Certificate', 'Google', '2023-03-20', 'certs/google_bob.pdf');

--projects table
INSERT INTO projects (project_id, user_id, title, description, technologies, github_link, live_demo_link, image_path, created_at)
VALUES
(1, 1, 'Student Portal System', 'Web-based student portal with login, profile management, and course enrollment.', 'HTML, CSS, PHP, MySQL', 'https://github.com/nishacodes/student-portal', 'https://nisharathi.dev/portal', 'images/student_portal.png', DEFAULT),
(2, 2, 'AI Chatbot', 'A chatbot powered by NLP and deep learning for customer service.', 'Python, TensorFlow, Flask', 'https://github.com/alicej/chatbot', 'https://chatbot.alice.dev', 'images/chatbot.jpg', DEFAULT),
(3, 3, 'Portfolio Website', 'A responsive personal portfolio built using React.', 'React, CSS, Netlify', 'https://github.com/bsmith/portfolio', 'https://bobsmith.dev', 'images/portfolio.jpg', DEFAULT);

--resumes table
INSERT INTO resumes (resume_id, user_id, file_path, uploaded_at)
VALUES
(1, 1, 'resumes/nisha_resume.pdf', DEFAULT),
(2, 2, 'resumes/alice_resume.pdf', DEFAULT),
(3, 3, 'resumes/bob_resume.pdf', DEFAULT);