SELECT * FROM `students`;

SELECT prenom FROM students;

SELECT prenom, datenaissance, school FROM students;

SELECT * FROM students WHERE genre = 'F';

SELECT * FROM students WHERE school = 'Addy';

SELECT prenom FROM students ORDER BY prenom DESC;

SELECT prenom FROM students ORDER BY prenom DESC LIMIT 2;

INSERT INTO students (prenom, nom, datenaissance, school, genre )
VALUES ('Ginette', 'Dalor', '1930-01-01', 1, 'F');

UPDATE students
SET prenom = 'Omer', gender = 'M'
WHERE prenom = 'Ginette' AND nom = 'Dalor';

DELETE FROM students WHERE id = 3;

UPDATE school
SET school = CASE
    WHEN idschool = 1 THEN 'Liege'
    WHEN idschool = 2 THEN 'Genk'
    ELSE school
END;
