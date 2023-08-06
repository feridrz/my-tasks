create table grade
(
    grade int null,
    min_mark int null,
    max_mark int null
);
create table students
(
    id int null,
    name varchar(100) null,
    marks int null
);

-- POPULATE TABLES WITH DATA
INSERT INTO grade (grade, min_mark, max_mark)
VALUES
    (1, 0, 50),
    (2, 51, 60),
    (3, 61, 70),
    (4, 71, 80),
    (5, 81, 90),
    (6, 91, 100);

INSERT INTO students (id, name, marks)
VALUES
    (1, 'John Doe', 45),
    (2, 'Jane Doe', 55),
    (3, 'Robert Smith', 65),
    (4, 'Emily Johnson', 75),
    (5, 'William Brown', 85),
    (6, 'Elizabeth Davis', 95);


-- PART A OF TASK
SELECT
    CASE
        WHEN marks >= 8 THEN name
        ELSE 'low'
        END as name,
    grade,
    marks
FROM
    (
        SELECT
            s.name,
            g.grade,
            s.marks
        FROM
            students s
                INNER JOIN
            grade g ON s.marks BETWEEN g.min_mark AND g.max_mark
        ORDER BY
            g.grade DESC,
            CASE
                WHEN s.marks >= 8 THEN s.name
                END ASC,
            CASE
                WHEN s.marks < 8 THEN s.marks
                END ASC
    ) subquery;

-- PART B OF TASK
CREATE INDEX idx_students_marks ON students(marks);
CREATE INDEX idx_grade_grade ON grade(grade);
