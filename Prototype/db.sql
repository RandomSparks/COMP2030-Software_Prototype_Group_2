SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS PROTOTYPE_DB; /* Remove if required */ 
CREATE DATABASE PROTOTYPE_DB;

USE PROTOTYPE_DB;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON PROTOTYPE_DB.Task TO dbadmin@localhost;

/* BELOW IS EXAMPLE FROM PRAC 3 


CREATE TABLE Task(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(100),
    completed boolean NOT NULL DEFAULT 0,
    updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) AUTO_INCREMENT = 1;


INSERT INTO Task(name) VALUES('Complete Checkpoint 1');
INSERT INTO Task(name) VALUES('Complete Checkpoint 2');
INSERT INTO Task(name) VALUES('Complete Checkpoint 3');
INSERT INTO Task(name) VALUES('Complete Checkpoint 4');
INSERT INTO Task(name) VALUES('Complete Checkpoint 5');
*/

/* Create factory_logs table */
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

/* Load data from the CSV file into the factory_logs table */
LOAD DATA INFILE 'path/to/factory_logs.csv'
INTO TABLE factory_logs
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(@timestamp, machine_name, temperature, pressure, vibration, humidity, power_consumption, operational_status, error_code, production_count, maintenance_log, speed)
SET timestamp = STR_TO_DATE(@timestamp, '%d/%m/%Y %H:%i');