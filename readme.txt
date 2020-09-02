THIS IS MUCH FASTER TO GET CSV FILE INTO MYSQL DATABASE 
LOAD DATA INFILE ‘c:\\data\\file_to_import.csv’
INTO TABLE TableName
CHARACTER SET latin1 — or utf8
COLUMNS TERMINATED BY ‘,’
OPTIONALLY ENCLOSED BY ‘”‘
ESCAPED BY ‘\’
LINES TERMINATED BY ‘\n’
IGNORE 1 LINES — Remove header ligne
( column1,column2,column3,column4,column5, ….. );