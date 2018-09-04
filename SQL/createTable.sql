CREATE TABLE users(
	username VARCHAR(50) NOT NULL,
    pword VARCHAR(255) NOT NULL,
    email VARCHAR(50) NOT NULL,
    dispName VARCHAR(50) NOT NULL,
    fname VARCHAR(50),
    lname VARCHAR(50),
    country VARCHAR(50),
    about VARCHAR(255),
    CONSTRAINT users_pk PRIMARY KEY (username)
);