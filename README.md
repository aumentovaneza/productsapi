# Documentation

## Instructions for setting-up and running the project
- Run `docker-compose up -d` to start the project.
- Run `docker exec -it <container_id> bash` to ssh inside the container.
- Once you are inside the container, you need to run `composer install` to install the dependencies.
- You also need to run the migrations with seeders, so you need to run this command  `php artisan migrate --seed`
- Lastly, you need to run  `php artisan passport:install` to create keys for Laravel passport. You only need to run this once for new set-up. If you need to refresh your token, you just need to run `php artisan passport:install --force` 

## Instructions for using the API
You will need a tool like **Postman** to test the API. If you don't have that yet, please install it or use your favorite API development tool.

I already created a collection through postman. Use this [link](https://www.getpostman.com/collections/730260bc5a4ae18a9044) to download then you can import the data to your API tool.

## Improvements
- We can pass a user id to the endpoints for getting products or getting user data instead of just checking the currently logged in user id so that the endpoints can be flexible and reusable with other features in the future.
- We can create more Resource to organize the response data.
- Instead of creating a new login function, we can use the Laravel Passport's  `oauth\token` endpoint to generate login token for the user.
- We can add the necessary unit tests for the functions created or use Laravel Dusk if there is already a UI connected to this backend.
- We can implement **Softdeletes** to models where this is necessary.
