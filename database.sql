CREATE TABLE projects (
    id serial primary key,
    title varchar(255),
    description text,
    skills varchar(255),
    image varchar(255),
    url_to_run varchar(255),
    url_src varchar(255),
    created_at timestamp,
	updated_at timestamp
);

CREATE TABLE messages (
    id serial primary key,
    name varchar(255),
    email varchar(255),
    text text,
    created_at timestamp,
	updated_at timestamp
);
