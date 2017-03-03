# _Shoe Stores_

#### _Silex application that allows user to create (add), read (view), update (edit), and delete shoe stores, shoes, and brands, 03/03/2017_

#### By _**Philip Putnam**_

## Description

_This application will display current shoe stores, then upon user interaction will display the brands of shoe that are available at each store. The user will be able to select a brand to see all stores that are currently selling that brand._

## Setup/Installation Requirements

### Method 1:
* _Using a web browser or terminal, clone the repository at https://github.com/philip-putnam/shoe-stores __
* _Navigate to the project directory, at the top level of the project directory in a terminal, type:
> composer install --prefer-source --no-interaction
OR simply:
> composer install_
* _After composer has finished installation, navigate to the 'web' folder within the project directory using a terminal. Create a document '.htaccess' with the following content:

<IfModule mod_rewrite.c>
     Options +FollowSymLinks -MultiViews
     # Turn mod_rewrite on
     RewriteEngine On
     RewriteBase /

     ## If the request is for a valid directory
     RewriteCond %{REQUEST_FILENAME} -d [OR]
     ## If the request is for a valid file
     RewriteCond %{REQUEST_FILENAME} -f [OR]
     ## If the request is for a valid link
     RewriteCond %{REQUEST_FILENAME} -l
     ## don't do anything
     RewriteRule ^ - [L]

     # if requested files exists in /web then forward it there
     RewriteCond %{DOCUMENT_ROOT}/web/$1 -f
     RewriteRule ^(.+?)/?$ /web/$1 [L]

     # if requested files doesn't exist in /web then forward it to index.php
     RewriteCond %{DOCUMENT_ROOT}/web/$1 !-f
     RewriteRule ^(.+?)/?$ ./index.php [L]
   </IfModule>_
* _Begin a web server using MAMP or similar software, indicating the 'web' folder as root_
* _In a compatible web browser, type in 'localhost:8888' where '8888' is the port number that you have indicated as your Apache port in MAMP or similar software_
* _Fill in the form on the webpage and hit submit!_

### Creating MySQL database

* _Open MAMP and begin Apache & MySQL server on your computer_
* _After cloning project from Github, open terminal and navigate to the top level of the project directory_
* _in the terminal type:_
* _> /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot_
* _> CREATE DATABASE shoes;_
* _> USE shoes;_
* _> CREATE TABLE shoes (id serial PRIMARY KEY, name VARCHAR (255), brand_id int);_
* _> CREATE TABLE brands (id serial PRIMARY KEY, name VARCHAR (255));_
* _> CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR (255), address VARCHAR (255), phone VARCHAR (255));_
* _Open Apache server from either MAMP or navigating to localhost:<apache-port#>/MAMP/ , where <apache-port#> is the port number indicated for the Apache port in MAMP Preferences..._
* _Click phpMyAdmin link, then click on the shoes database on the left of the screen_
* _Click the 'operations' tab, in 'Copy database to:' type shoes_test and select 'Structure only' then click 'Go'_

## Specifications

| Expected Behavior: application will... | Input | Output |
| ----------------- | ------------------ | ----- | ------ |
| display all local shoe stores | user navigates to main page | "Nike Puma Adidas" |
| display all brands located at store | user navigates to store page | "Nike Adidas" |
| display all stores carrying specific brand | user navigates to brand page | "Pa's Shoes, Nike Factory" |
| add store to list of stores | "Joe's Shoe Emporium" | "Pa's Shoes, Nike Factory, Joe's Shoe Emporium" |
| add brand to a store | "Puma" | "Nike Adidas Puma" |

## Known Bugs

_No known bugs at this time_

## Support and contact details

_Please e-mail Philip Putnam, at staplehead989@gmail.com for support with the webpage_

## Technologies Used

_HTML_
_CSS_
_PHP_
_Bootstrap_
_Atom_
_Git_
_GitHub_
_MySQL_
_Apache_

### License

*This webpage is licensed under the MIT license*

Copyright (c) 2017 **_Philip Putnam_**