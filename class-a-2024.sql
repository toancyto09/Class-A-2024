CREATE DATABASE SampleDB;
GO
USE SampleDB;
GO

CREATE TABLE Employees (
    EmployeeID INT PRIMARY KEY,
    FirstName NVARCHAR(50),
    LastName NVARCHAR(50),
    Email NVARCHAR(100),
    HireDate DATE
);
GO
INSERT INTO Employees (EmployeeID, FirstName, LastName, Email, HireDate)
VALUES (1, 'John', 'Doe', 'johndoe@example.com', '2022-01-01');
GO

select * from dbo.tasks

