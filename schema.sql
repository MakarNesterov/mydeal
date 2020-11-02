CREATE DATABASE mydeal; 

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(30),
    email VARCHAR(30),
    pass VARCHAR(30),
    PRIMARY KEY(id)
);

CREATE TABLE project (
    id INT NOT NULL AUTO_INCREMENT,
    category VARCHAR(30),
    userID INT,
    PRIMARY KEY(id),
    FOREIGN KEY(userID) REFERENCES users(id)
);

CREATE TABLE task (
    id INT NOT NULL AUTO_INCREMENT,
    task_name VARCHAR(30),
    link VARCHAR(30),
    status_value INT,
    date_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    deadline DATE,
    userID INT,
    projectID INT,
    PRIMARY KEY(id),
    FOREIGN KEY(userID) REFERENCES users(id),
    FOREIGN KEY(projectID) REFERENCES project(id)
);


CREATE UNIQUE INDEX taskID ON task(task_name);

CREATE INDEX categoryID ON project(category); 



