CREATE TABLE todolist(
    id SERIAL PRIMARY KEY,
    todo varchar(255) NOT NULL
);

select * from todolist;

SELECT *
FROM pg_catalog.pg_tables