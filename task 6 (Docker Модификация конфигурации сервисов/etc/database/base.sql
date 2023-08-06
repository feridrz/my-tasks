CREATE DATABASE IF NOT EXISTS my_database;
USE my_database;

CREATE TABLE IF NOT EXISTS my_table (
                                        id INT AUTO_INCREMENT,
                                        column1 VARCHAR(255) NOT NULL,
    column2 INT NOT NULL,
    PRIMARY KEY (id)
    );
