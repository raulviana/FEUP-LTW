

# LTW
Repository for the Web Languages and Technologies [(**LTW**)](https://sigarra.up.pt/feup/pt/ucurr_geral.ficha_uc_view?pv_ocorrencia_id=459485)course.

## Tools
PHP, Javascript, CSS, SQLITE3

## Usage
Download repostitory, run 
'''
php -S localhost 8080
'''

It may be necessary to edit php.ini file to activate **gd2** and **pdo_sqlite** libraries and/or install them.



## LTW Project - PetRescue

### Description
The project goal was to develop a web site to connect founders of abandoned animals to its new owners. The founders create an add with the animal information and the future owners browse the available animals to select the ideal one. It is possible to make a proposal and post queries and answers in each animal mini forum.

### Snapshots

Some website pages images:


![Main Page SnapShot](https://raw.githubusercontent.com/raulviana/FEUP-LTW/master/images/main.png)
Main Page


![LogIn Page](https://raw.githubusercontent.com/raulviana/FEUP-LTW/master/images/login.png)
LogIn Page


![Register Page](https://raw.githubusercontent.com/raulviana/FEUP-LTW/master/images/register.png)
Register Page


![Pet Page](https://raw.githubusercontent.com/raulviana/FEUP-LTW/master/images/petpage.png)
Pet Page



### Elements:
 - Raul Viana (201208089)

### Credentials
 - jhon_doe@example.com/123 (client)
 - jane_31@example.com/123 (client)
 - karen_95@example.com/123 (client)

### Libraries:
 - **GD** library to scale and convert the uploaded images to standard internal size and type. This library was used in "templates/files/process-files.php" file. 
 - **pdo_sqlite** to to prepare the queries and query the sqlite3 database.
### Features:
 - Security
     - **XSS**: yes - filtering all possible user manipulated input with Regex expressions
     - **CSRF**: yes - in all "action" type php files accepting forms
     - **SQL** using prepare/execute: yes - in all queries
     - **Passwords**: was used the "password_hash" and "password_verify" PHP functions, which automatically insert the salt in the hashed password and extracts it afterward to make the password verification.
     - **Data Validation**: 
        - **regex** -> all inputs liable of user manipulation
        - **php** -> password length and presence of upper character
        - **html** -> required and check for password confirmation 
     - **Other**: files are stores with database id name and not with original user uploaded name.
 - Technologies
     - **Separated logic/database/presentation**: yes
     - **Semantic HTML tags**: yes
     - **Responsive CSS**: partially, almost all horizontal CSS values are percentages, which allows shrinking the page until approximately 500 pixels. It wasn't implemented different size page layouts. 
     - **Javascript**: yes
     - **Ajax**: yes - adding and deleting posts in pet-page.php and accepting proposals in proposal-list.php 
     - **REST API**: no
 - Usability:
     - **Error/success messages**: yes; in PHP, except when it was made an AJAX request. In these cases, the messages were generated and processed in Javascript. 
     - **Forms don't lose data on error**: yes, they don't. 
