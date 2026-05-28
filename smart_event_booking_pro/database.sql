DROP DATABASE IF EXISTS smart_event_booking;
CREATE DATABASE smart_event_booking;
USE smart_event_booking;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','user') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  category VARCHAR(50) NOT NULL,
  venue VARCHAR(150) NOT NULL,
  event_date DATETIME NOT NULL,
  price DECIMAL(10,2) DEFAULT 0,
  capacity INT DEFAULT 50,
  status VARCHAR(30) DEFAULT 'Open',
  description TEXT NOT NULL,
  ai_log TEXT,
  created_by INT,
  updated_by INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
  FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  event_id INT NOT NULL,
  tickets INT NOT NULL,
  total_price DECIMAL(10,2) NOT NULL,
  status VARCHAR(30) DEFAULT 'Confirmed',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
);

CREATE TABLE audit_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NULL,
  action VARCHAR(100) NOT NULL,
  details TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

INSERT INTO users(name,email,password,role) VALUES
('Admin User','admin@example.com','$2y$12$qY6WSwEi429cWT8CbN2U5edBKga2ogGR0o1U.5e0KzsfvIpCK5M2a','admin'),
('Standard User','user@example.com','$2y$12$7ZJJBp5Ga0th6o4GmzFGkepp6w7KtGhmVMFr0qIUlWp2y5/1830OG','user');

INSERT INTO events(title,category,venue,event_date,price,capacity,status,description,ai_log,created_by,updated_by) VALUES
('Perth Food and Culture Night','Food','Alfornetto Community Hall','2026-06-15 18:00:00',25.00,80,'Open','A friendly food and culture night featuring local dishes, music and community networking. Guests can enjoy a relaxed environment and connect with local organisers.','Seed content reviewed by admin.',1,1),
('Web Development Beginner Workshop','Workshop','CIHE Computer Lab','2026-06-20 10:00:00',15.00,35,'Open','A beginner-friendly workshop covering HTML, CSS, PHP and MySQL basics. Suitable for students who want practical web development experience.','Seed content reviewed by admin.',1,1),
('Community Football Weekend','Sport','City Sports Ground','2026-07-02 09:00:00',10.00,120,'Open','A weekend sport event for community members, friends and families. The event encourages teamwork, fitness and positive participation.','Seed content reviewed by admin.',1,1),
('Student Networking Evening','Networking','Crown Institute Hall','2026-07-10 17:30:00',5.00,100,'Open','A professional networking evening for students to meet peers, discuss career goals and build communication confidence.','Seed content reviewed by admin.',1,1);

INSERT INTO bookings(user_id,event_id,tickets,total_price,status) VALUES
(2,1,2,50.00,'Confirmed'),
(2,2,1,15.00,'Confirmed');

INSERT INTO audit_logs(user_id,action,details) VALUES
(1,'System setup','Initial demo data created'),
(2,'Created booking','Perth Food and Culture Night');
