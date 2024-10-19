SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS PROTOTYPE_DB; -- Remove if required
CREATE DATABASE PROTOTYPE_DB;

USE PROTOTYPE_DB;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON PROTOTYPE_DB.Task TO dbadmin@localhost;

-- Create factory_logs table
CREATE TABLE factory_logs (
    timestamp DATETIME NOT NULL,
    machine_name VARCHAR(255) NOT NULL,
    temperature FLOAT,
    pressure FLOAT,
    vibration FLOAT,
    humidity FLOAT,
    power_consumption FLOAT,
    operational_status VARCHAR(50),
    error_code VARCHAR(50),
    production_count INT,
    maintenance_log TEXT,
    speed FLOAT
);

-- Load data from the CSV file into the factory_logs table
LOAD DATA INFILE '/Applications/XAMPP/xamppfiles/htdocs/www/COMP2030-Software_Prototype_Group_2/factory_logs.csv'
INTO TABLE factory_logs
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(@timestamp, machine_name, temperature, pressure, vibration, humidity, power_consumption, operational_status, error_code, production_count, maintenance_log, speed)
SET timestamp = STR_TO_DATE(@timestamp, '%d/%m/%Y %H:%i');



-- Create users table
CREATE TABLE users (
    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id TEXT NOT NULL
);

-- Example users (passwords should be hashed in a real application)
INSERT INTO users (username, password, role_id) VALUES
('admin', 'admin_password', 'Administrator'),
('test_manager', 'manager_password', 'Manager'),
('test_operator', 'operator_password', 'Operator'),
('test_auditor', 'auditor_password', 'Auditor');

-- Create Notes table with machine_name column
CREATE TABLE Notes(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(100),
    content text,
    machine_name varchar(255),
    updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) AUTO_INCREMENT = 1;

-- Insert example notes
INSERT INTO Notes(name, content, machine_name) VALUES('Note from Production Operator Belic', 'The CNC is machine is running into some issues, we need someone to come and fix it pronto', 'CNC Machine');
INSERT INTO Notes(name, content, machine_name) VALUES('Note from PO Jeremy', 'Can someone let Belic know that ive turned his CNC off for the moment to fix the printer? Thanks.', '3D Printer');
INSERT INTO Notes(name, content, machine_name) VALUES('Note Farmers Union Iced Coffee', 'I like the strong version of the coffee', 'Automated Assembly Line');
INSERT INTO Notes(name, content, machine_name) VALUES('Note from PO Bob', 'Sorry about the above note, I didn''t mean to press send and I forgot which button I have to press to delete it.', 'Automated Assembly Line');

-- Insert machine names from factory_logs into Notes table

CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_name VARCHAR(255) NOT NULL UNIQUE,
    job_completed BOOLEAN DEFAULT FALSE,
    date_started DATE NOT NULL,
    date_completed DATE DEFAULT NULL,
    job_allocated VARCHAR(255),
    job_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create job_notes table that stores notes for jobs and references job_name
CREATE TABLE job_notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_name VARCHAR(255) NOT NULL,
    note TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (job_name) REFERENCES jobs(job_name)
);