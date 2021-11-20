

## Application Starting procedure 
- Pull this repository
- PHP 7.3 > & MYSQL 5.7 needed
- Install composer dependencies with command :   `` composer install ``
- Create new file .env and copy paste content from .env.example file
- Change the default database related configuration inside .env file 
```  DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=your_database
      DB_USERNAME=database_user_name
      DB_PASSWORD=database_password
  ```
- After setting up the environment, run `` php artisan migrate `` command in terminal.
- After completing all above steps, now you can serve your laravel application by entering ``` php artisan serve ```
  command. Application up and run  http://localhost:8000
  
- For accessing guess number page you need to register your information so please goto register page and fill all the necessary information and hit register button.

- After successful registration you may login with registered credentials and you will see the guess number input field  

- Guess number game also available in command line  
  ```
    php artisan guess:number
   ```

 ## Number guess dialog
  <p align="center"><img src="../master/public/images/screen1.png"></p>
 
## Guessing History 
<p align="center"><img src="../master/public/images/screen2.png"></p>


## Console Game 
<p align="center"><img src="../master/public/images/terminal.png"></p>
