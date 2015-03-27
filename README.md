# JONATHAN LIN

### This is a website that allows the user to keep track of shoe brands and the stores that sell them. The user can input either a store or a shoe brand. They can then enter the stores that sell that brand or what brands a store sells.

### Technologies used :
#### PHPUNIT
#### Silex
#### Twig
#### Test Driven Development
#### PHP/HTML
#### POSTGRES
#### DATABASES

#### Setup Instructions
##### Download all attached files. Host a local server. Input the local server address in the address bar. To replicate the database, start POSTGRES and PSQL in the terminal window. If you have it installed type POSTGRES in one window and open another window and type PSQL. The commands are -  CREATE DATABASE shoes;
#####\c shoes;
#####CREATE TABLE stores (id serial PRIMARY KEY, name varchar);
#####CREATE TABLE brands (id serial PRIMARY KEY, name varchar);
#####CREATE TABLE stores_brands (id serial PRIMARY KEY, stores_id int, brands_id int);
#####CREATE DATABASE shoes_test WITH TEMPLATE shoes;
#####You can also recreate the databases by using the SQL files. Start psql from the project root folder
#####CREATE DATABASE shoes;
#####\c shoes;
#####\i shoes.sql
#####CREATE DATABASE shoes_test;
#####\c shoes_test;
#####\i shoes_test.sql

### COPYRIGHT @ LIndustries Consolidated
####### All rights reserved
####### Application free to use, not to profit.
