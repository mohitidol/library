CREATE TABLE books (
   BookId int(11) NOT NULL auto_increment,
   Name varchar(100) NOT NULL,
   Description varchar(500) NOT NULL,
   Status varchar(100) NOT NULL,
   PRIMARY KEY (BookId)
 );
 
 CREATE INDEX index_book_name ON books (Name);
 
 INSERT INTO books ( Name, Description, Status)
     VALUES  ('Life is What you Make It',  '
Life Is What You Make It is a fictional story about a strong female character whose life takes unexpected turns and how she uses her indomitable spirit to make the most of it.', 'Available'), 
			 ('Indian Polity 5 Edition',  'McGraw Hill is proud to present the fifth edition of Indian Polity by M Laxmikanth. The book itself needs no introduction. It is one of the most popular and comprehensive books on the subject and has been a consistent bestseller for many years. The extant chapters have been completely revised and updated with recent developments.', 'Issued'),
			 ('Indian History : For Civil Services Examinations Second Edition',  '
McGraw Hill Education is proud to present the second edition of Indian History By Krishna Reddy which provides a comprehensive approach to the various aspects of the subject. This book is meant for Civil Services Preliminary and Main Examinations, State Civil Services Examinations and other competitive examinations where History is an important area.', 'Available'),
			 ('Wings of Fire: An Autobiography 1st Edition',  'Published in the year 2000, Wings Of Fire: An Autobiography is a book that documents the life of A. P. J. Abdul Kalam, and inspires the readers to ignite the fire within themselves.', 'Available');
