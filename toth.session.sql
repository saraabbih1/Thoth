CREATE TABLE IF NOT EXISTS students (
    id INT auto_increment PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(150) NOT NULL 
);

CREATE TABLE if NOT EXISTS courses(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200)NOT NULL,
    description TEXT
);

CREATE TABLE IF NOT EXISTS enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY , 
     student_id INT NOT NULL,
    course_id INT NOT NULL,
    enrollment_id DATETIME DEFAULT CURRENT_TIMESTAMP,
    Foreign Key (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);