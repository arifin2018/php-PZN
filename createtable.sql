create sequence todolist_id_seq

CREATE TABLE todolist(
    id INT unique PRIMARY KEY,
    todo varchar(255) NOT NULL
);

show tables;