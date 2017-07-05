//This files has all command to create database and tables which are required for this system
//Creating database Windows 
CREATE DATABASE windows;
//Creating user to access database
CREATE USER 'update'@'localhost' IDENTIFIED BY '123456';
//Giving the user premmission grant premmission on this database;
GRANT ALL PRIVILEGES ON windows.* TO 'update'@'localhost';
FLUSH PRIVILEGES;
//Selecting database windows
use windows;
//Creating table info_windows 
CREATE TABLE  info_windows (
mac VARCHAR(12) PRIMARY KEY NOT NULL,
name VARCHAR(12) NOT NULL,
username VARCHAR(20) NOT NULL,
time VARCHAR(20) NOT NULL,
status VARCHAR(20) NOT NULL,
download VARCHAR(3) NOT NULL
);

