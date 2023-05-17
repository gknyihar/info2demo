DROP SCHEMA IF EXISTS tasks;
CREATE SCHEMA IF NOT EXISTS tasks;
USE tasks;

CREATE TABLE users (
                       id int auto_increment,
                       username varchar(255) not null,
                       name varchar(255) not null,
                       email varchar(255) not null,
                       primary key(id)
);

CREATE TABLE tasks (
                       id int auto_increment,
                       title varchar(255) not null,
                       description text not null,
                       status enum('new', 'in_progress', 'done') not null default 'new',
                       user_id int not null references users(id),
                       primary key(id)

);


INSERT INTO users(id, username, name, email) VALUES(1, 'evelin123', 'Nagy Evelin', 'evelin123@gmail.com');
INSERT INTO users(id, username, name, email) VALUES(2, 'kbalint', 'Kovács Bálint', 'kbalint@yahoo.com');
INSERT INTO users(id, username, name, email) VALUES(3, 'vajan', 'Varga János', 'vajan@freemail.hu');

INSERT INTO tasks(user_id, title, description, status) VALUES(1, 'Programozás', 'Megtanulni PHP-ban programozni', 'done');
INSERT INTO tasks(user_id, title, description, status) VALUES(1, 'Laravel', 'Utánanézni a Laravel keretrendszernek', 'in_progress');
INSERT INTO tasks(user_id, title, description, status) VALUES(1, 'IDE', 'Fejlesztő környezet telepítése', 'new');
INSERT INTO tasks(user_id, title, description, status) VALUES(1, 'Architecture', 'Használni az alapvető architekturális mintákat', 'new');

INSERT INTO tasks(user_id, title, description, status) VALUES(2, 'HTML', 'Szemantikus HTML-t használni', 'done');
INSERT INTO tasks(user_id, title, description, status) VALUES(2, 'CSS', 'Kirpóbálni CSS keretrendszereket', 'new');

INSERT INTO tasks(user_id, title, description, status) VALUES(3, 'JS', 'Kód kiegészítése JS kóddal', 'new');
INSERT INTO tasks(user_id, title, description, status) VALUES(3, 'Frameworks', 'JS keretrendszereket gyűjteni', 'new');
INSERT INTO tasks(user_id, title, description, status) VALUES(3, 'Typescript', 'Refaktorálni typscriptre', 'new');
