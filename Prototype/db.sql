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
INSERT INTO Notes(name, content, machine_name) VALUES('Example note 1', 'This is an example note with some content', 'Machine1');
INSERT INTO Notes(name, content) VALUES('Example note 2', 'This is another example note with some content');

-- Insert machine names from factory_logs into Notes table
