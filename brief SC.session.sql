CREATE DATABASE IF NOT EXISTS `briefsc`;

-- --@block
-- CREATE TABLE IF NOT EXISTS `user` (
--     id int(11) NOT NULL auto_increment PRIMARY KEY ,
--     email VARCHAR(255) NOT NULL,
--     name VARCHAR(255) NOT NULL,
--     password int(11) NOT NULL,
--     role int(11) NOT NULL
-- )


-- --@block
-- CREATE TABLE IF NOT EXISTS `wiki` (
--     id int(11) NOT NULL auto_increment PRIMARY KEY ,
--     title VARCHAR(255) NOT NULL,
--     contenu longtext(255) NOT NULL,
--     created_at DATETIME NOT NULL,
--     category_id int(11) NOT NULL,
--     tag_id int(11) NOT NULL,
--     created_by int(11) NOT NULL,
--     foreign key (category_id) references category(id),
--     foreign key (tag_id) references tag(id),
--     foreign key (created_by) references user(id)
-- )

-- --@block
-- CREATE TABLE IF NOT EXISTS `category` (
--     id int(11) NOT NULL auto_increment PRIMARY KEY ,
--     name VARCHAR(255) NOT NULL
-- )

-- --@block
-- CREATE TABLE IF NOT EXISTS `tag` (
--     id int(11) NOT NULL auto_increment PRIMARY KEY ,
--     name VARCHAR(255) NOT NULL
-- )

-- --@block
-- CREATE TABLE `wikitag` (
--     id int(11) NOT NULL auto_increment PRIMARY KEY ,

-- )

--@block
CREATE TABLE Categories (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(50) NOT NULL,
    description TEXT
);


CREATE TABLE Tags (
    tag_id INT PRIMARY KEY AUTO_INCREMENT,
    tag_name VARCHAR(50) NOT NULL
);

CREATE TABLE Authors (
    author_id INT PRIMARY KEY AUTO_INCREMENT,
    author_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Wikis (
    wiki_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    content TEXT,
    author_id INT,
    category_id INT,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_archived BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (author_id) REFERENCES Authors(author_id),
    FOREIGN KEY (category_id) REFERENCES Categories(category_id)
);

CREATE TABLE Wiki_Tags (
    wiki_id INT,
    tag_id INT,
    FOREIGN KEY (wiki_id) REFERENCES Wikis(wiki_id),
    FOREIGN KEY (tag_id) REFERENCES Tags(tag_id),
    PRIMARY KEY (wiki_id, tag_id)
);

--@block
RENAME TABLE Authors TO users;

--@block
ALTER TABLE users
ADD COLUMN role enum('admin', 'auteur', 'visiteur');