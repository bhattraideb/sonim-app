## About Company list API

Company list API A basic application developmed in Laravel 7.4 to demonstrate RESTful concept and web crud operation. I have implemented four functionality in this API: Register, Add, Update, Change password for users and List/Delete Companies and admin users. This API will act as Backend and can be used for any front end frameworks like AngularJs, VueJs.
 
 ## How to install 
 - Download or clone the project in your working directory.
 - Once got downloaded go to project root directory from terminal and run following cammands to make sure that all dependency is up-to date.:
     - 'composer install'
     - 'composer dump-autoload'
     - Make sure, bootstrap/cache and storage/... directories exists and writable in the project as per laravel directory structure. For detail you can check here: https://laravel.com/docs/7.x/structure 
     - Finally run 'php artisan optimize:clear' command.
     - You cann run 'php artisan db:seed' to fill some company/admin data to companies/company_admins tables.
 - I highly recommend to create virtual host, In my case I created "http://sonimapp.local/". 
    For creating virtual host on nginx you can check this link: https://linuxize.com/post/how-to-set-up-nginx-server-blocks-on-ubuntu-18-04/ 
    
   - Now go to browser and type http://sonimapp.local. It will show landing page. You can register as a new user. Once done you can see company/ admin list by clicking on respective tab menu. You can do basic CRUD operation from here for both company and admins.
   
   - If you want to test the API, You can do it with the postman.
   - I have tested following links and working properly.
        
            - POST: http://sonimapp.local/api/v1/users/register    
                Sample Data to pass:
                 {
                    "name": "Test name",
                    "email": "testuser@gmail.com",
                    "password": "Admin123",
                }
                
                
            - POST: http://sonimapp.local/api/v1/users/signin
                Sample Data to pass:
                {
                "email":"testuser@gmail.com",
                "password":"12345678"
                }
       
       
            - POST:  http://sonimapp.local/api/v1/users/changepassword/
                Sample Data to pass:
                 {
                    "password": "Admin123",
                }     
                
                
            - GET: http://sonimapp.local/api/v1/users/logout?token=[token_goes_here]
                -- pass access_token as Authorization from postman
                
            - GET: http://sonimapp.local/api/v1/company/list  
                            
            - GET: http://sonimapp.local/api/v1/company/delete/{id}       
                          
            - GET: http://sonimapp.local/api/v1/company/admin/list      


        
## How to implement with front end framework
  To integrate this API with front end framework just call the links:
  - http://sonimapp.local/api/v1/user/register
  - http://sonimapp.local/api/v1/users/signin 
  - http://sonimapp.local/api/v1/users/changepassword/
  - http://sonimapp.local/api/v1/users/logout
       -- pass access_token as Authorization
  - http://sonimapp.local/api/v1/company/list
  - http://sonimapp.local/api/v1/company/delete/{id}
  - http://sonimapp.local/api/v1/company/admin/list 

  
  For register and update you have to pass the data in JSON format as given above.
  
  
  ## Testcases
I have created and tested two classes for unit testing. You can run these from terminal inside you project directory with these commands: 
  - vendor/bin/phpunit tests/Feature/CompanyTest.php
  - vendor/bin/phpunit tests/Feature/CompanyAdminTest.php

