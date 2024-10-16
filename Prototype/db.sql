SET @@AUTOCOMMIT = 1;

-- DROP DATABASE IF EXISTS PROTOTYPE_DB; -- Remove if required
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
LOAD DATA INFILE '"C:/Users/patz1/Documents/factory_logs.csv"'
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