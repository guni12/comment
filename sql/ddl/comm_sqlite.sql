--
-- Creating a sample table.
--



--
-- Table Book
--
DROP TABLE IF EXISTS Comm;
CREATE TABLE Comm (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "userid" TEXT NOT NULL,
    "email" TEXT NOT NULL,
    "title" TEXT NOT NULL,
    "comment" TEXT NOT NULL,
    "parentid" TEXT,
    "created" TIMESTAMP,
    "updated" DATETIME
);
