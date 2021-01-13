# Symfony-App (work in progress)
Symfony App where you can watch videos after you subscribe.

Content:
  - How to install
  - How to run unit/functional tests
  - Database schema
  - SQL file
  
Steps:

  1. How to install:
  
     What do you need:
      - MySQL 
      - PHP version:7+
      
     Next:
      - Fork and Clone the repository
      - run "composer install" in terminal
     
  2. How to run unit/functional tests:
  
     In terminal run the following command: "./tests.sh" to run all tests after you start your MySQL server.
     Also, you can choose the folder you want to test, for example Twig, just run the following command: "/tests.sh tests/Twig".
     
  3. Database schema:
  
     Database schema can be found in the cloned folder, the name of picture is: "app-db-schema.png".
     You can rebuild DB from scratch including fixtures,and run all tests. To do so run the following command in the terminal:   "/tests.sh tests -db".
  4. 
     If it's more comfortable to you, just import the existing SQL file into your database, SQL file is named "symf4".
  
  Enjoy!
