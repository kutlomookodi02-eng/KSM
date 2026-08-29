use careers;

ALTER TABLE users 
ADD COLUMN department VARCHAR(100),
ADD COLUMN position VARCHAR(100),
ADD COLUMN runway_position VARCHAR(100);

SELECT * FROM users;
