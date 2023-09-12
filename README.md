# Laravel Backend Test Case
The Laravel version used is version 10.x 

## Steps as follows
Migrate Database
   ```
   php artisan migrate
   php artisan db:seed BookSeeder
   php artisan db:seed MemberSeeder
  ````
## Available Route API
1. List Members
   - Method: **GET**
   - URL: **api/members**
   
1. List Books
   - Method: **GET**
   - URL: **api/books**
     
3. Booking / Borrowed Book
   - Method: **POST**
   - URL: **api/borrowed**
5. Returned Book
   - Method: **DELETE**
   - URL: **/api/borrowed/returned/{id_book}**
### Note
1. Sorry, I'm not familiar with using Swagger as API Documentation.
2. This Postman URL https://www.postman.com/bold-meadow-333946/workspace/laravel-backend-api-test-case/collection/5780128-ac23fd23-f368-414f-9021-958c595b1fb5?action=share&creator=5780128
