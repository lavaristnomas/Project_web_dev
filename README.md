# Project_web_dev
In order to run everything appropriately you will need to follow the steps below:
1. download and run XAMPP
2. start APACHE and MySQL modules
3. open myphpadmin
4. create a database labeled "login"
5. create a table labeled "user" with 4 columns
6. the first column must be labeled "id" and set as an int(11) with auto_increment on
7. the second column must be labeled "username" and set as a varchar(255) and unique
8. the third column must be labeled "email" and set as a varchar(255) and unique
9. the fourth column must be labeled "password_hash" and set as a varchar(255)
10. add a row with the following information: username=admin, email=admin@example.com, password_hash=admin
11. create a table labeled "reviews" with 4 columns
12. the first column must be labeled "username" and set as varchar(255) and foreign key
13. the second column must be labeled "game" and set as a varchar(255)
14. the third column must be labeled "up_vote" and set as an int(11)
15. the fourth column must be labeled "down_vote" and set as an int(11)
16. select both the username and game columns and then create a unique index
17. add a row with the following information: username=admin, game=pong, up_vote=0 and down_vote=0
18. add a row with the following information: username=admin, game=snake, up_vote=0 and down_vote=0
19. add a row with the following information: username=admin, game=ttt, up_vote=0 and down_vote=0
20. go to localhost/path-to-signup.html, create an account and you're ready to enter the site!
