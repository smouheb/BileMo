# BileMo
======

BileMo is a webservice created from scratch.
With this app, you will be able to query the API with several HTTP Methods and I've also added a small reverse proxy (Symfony cache).
Once you will clone this project you will be able to add any modification you want.

# Technical environment:

 - Language => PHP 7.1
 - Framework => Symfony 3.4
 - Database => MySQL 5.6.38
 - Web Server => PHP built in web server

# Installation:

Choose the directory where you want this project to be saved.
or if you are using the command line, then go to the directory you want this project to be saved and copy paste the below:
git clone https://github.com/smouheb/BileMo.git

Once it is downloaded/saved, cd BileMo and then composer install.
you will be asked to:
- Add all the database information (hostname, port, databasename, usernanme, password...)
- When the ins the following command to create a database (if not already existing):
    bin/console doctrine:database:create
    then bin/console doctrine:schema:create.

### I have also prepared some fixtures so that you have some data to test, using the command line:

  - You will have a client that you can use to get the token for the authentication
  - There is a user with Admin Role (username = testuser1 and password =testuser1)
  - Last, some products have also be added
  
  to load this in the database use the command below:
  
  bin/console doctrine:fixtures:load

### Start the server (bin/console server:run), now you application is up and running, here are some examples to get a Token in order to query the API:

*address => http://127.0.0.1:8000/oauth/v2/token*

*header => Content-Type : application/json*

*Body:*

{
	'"grant_type": "password",
	"client_id": "concatenation between id._.random_id",
	"client_secret": "secret token",
	"username": "testuser1",
	"password": "testuser1"
}

### Note: Client_id and clien_secret are available in your database if you loaded the fixture as previously recommended. 
If not then use the command line *bin/console fos:oauth-server:create-client --grant-type="password"*.
The credential related to the user are also from the fixtures loaded in your db

once you get the response with the token *example below:*

{
    "access_token": "NTM1M2NhN2NhZWZjOTI4MWIwYTlkMDJjOWNjOTgwMjVkODYyMDJmYzlkYmQyZGIyMmU4N2ZjZWVhNGFjNDY2MQ",
    "expires_in": 3600,
    "token_type": "bearer",
    "scope": null,
    "refresh_token": "ZjZlMTAzZGI5ZTZmYTI5ZjA0MGVjN2ExMjliYzE2YzMzNWJjZmZiYzY4NjA1MDQzMjM2OGUxMzhhYzgxYmY5Mw"
}

### For any request, please copy paste the token into your header as follows:

Authorization : Bearer NTM1M2NhN2NhZWZjOTI4MWIwYTlkMDJjOWNjOTgwMjVkODYyMDJmYzlkYmQyZGIyMmU4N2ZjZWVhNGFjNDY2MQ


### All other informtion related to this api can be found under:
http://localhost:8000/api/doc

last, use Postman for your requests, that will be much easier to play around :)

### That's it, hope you guys will enjoy and if you need any support please don't hesitate to contact me


