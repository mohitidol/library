Library Project for Aptify by Mohit Mathur

SQL file attached with name: create_and_insert_table_books.sql

Please access the link by : http://book/book/public/book

Issue Book:http://book/book/public/book/issuebook
Return book : http://book/book/public/book/returnbook
Availability : http://book/book/public/book/checkavailability
List Book : http://book/book/public/book/listbook

or

Issue Book:http://book/book/issuebook
Return book : http://book/book/returnbook
Availability : http://book/book/checkavailability
List Book : http://book/book/listbook

once you make an Entry

Virtual Host File

<VirtualHost *:80>
	ServerName book
	DocumentRoot "c:/wamp/www/book/public"
	<Directory c:/wamp/www/book/public>
		DirectoryIndex index.php
		AllowOverride All
		Order allow,deny
		Allow from all
	</Directory>
</VirtualHost>

