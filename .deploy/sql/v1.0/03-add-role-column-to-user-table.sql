USE task_manager;

ALTER TABLE users
ADD COLUMN role VARCHAR(50) NOT NULL DEFAULT 'user';
