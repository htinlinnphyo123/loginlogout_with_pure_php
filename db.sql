CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    gender VARCHAR(6),
    dob DATE,
    role VARCHAR(20) DEFAULT 'user',
    password VARCHAR(100)
);

INSERT INTO users(name,email,gender,dob,password)
VALUES('mg mg','mgmg@gmail.com','male','2002-08-03','12345');