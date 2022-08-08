# InsApp
## Table of contents
  - [Overview](#overview)
  - [Screenshot](#screenshot)
  - [Built with](#built-with)
  - [About development](#about-development)
 
## Overview
Simple insurance app based on the MVC pattern. I created this project to practice PHP, CRUD and coding skills I've been learning.
Current version contains a login form and a basic user interface from a client perspective - to view insurance details, insurance events and read and update contact details. 
Admin interface will be added with the next update.


#### You can view the website on the following [Site Link](https://www.mozisa.eu/).


### Screenshot
https://github.com/amozisova/portfolio/blob/main/img/projects/insapp.png


### Built with
- PHP, MySQL, HTML5
- JavaScript
- CSS3, Twig


### About development
#### pattern structure, programming and database
- First I created the basic MVC structure of the app.
- I installed Composer and Twig and drafted the basic templates structure.
- I started programming from the Core classes and Config class, and continued with the User model to establish basic connection to the database and routing.
- Using phpMyAdmin I created a database table containing user data and login information.
- Then I built homepage with the login and added navigation.
- I added data to the database (created new tables and view) and I continued programming the specific sections of the app - insurances, events, contact details - to display data from the database and update them via form.

#### frontend
- Once the prototype of the app was completed, I used Figma to sketch the basic layout and the design. Then I started coding the templates and styling them. 
- I added JavaScript to the site (for toggle navigation).
- I was continuously testing responsiveness and functionality of all elements and refactoring the code accordingly.

#### refactoring
- In the final stage I checked all the parts for errors, deleted unnecessary lines of code, restructured some parts semantically and refactored code, trying to make it clean and comprehensive.
