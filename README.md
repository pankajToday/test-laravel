
## About Laravel

# test-laravel
- this is a sample project. where i try to show a CURD operation for post.
- this project has a Migration file, Model Seeders and Front-end is Vue JS 3.
- To use this project you have to follow some steps.
1. Clone this project.
2. Run composer install : composer install.
3. set the database name as you want in env file for example. :laravel_db.
4. run migration command: php artisan migrate
5. run DB Seed command: php artisan db:seed
6. now install all packages of npm by npm install.
7. now the project is ready to use. so run php artisan serve and npm run dev
8. this is a single-page project. where the first time you can create a new user or direct create a new post from Add new User or Add new Post button.
9. At a time only 5 post will be shown.
10. Images of the post is static and randomly attached to posts at run time..
11. Due to the limitation of time so i did not create a login page. so by default user_id will be set to 1 but if you are creating a user or not refreshing the page then the post will be created with a newly added user.