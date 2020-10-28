# AlbumGallery

Retrieves albums from a database and displays them in a grid.
Albums can also be edited, deleted, and created.

### Quick Project Setup
###### (Not including the dev environment)
1. Clone this repo
2. Install [Composer](https://getcomposer.org/download).
2. Create a MySQL database for the project (default name is albumgallery but this can be specified in `.env`)
3. From the projects root run `cp .env.example .env`
4. Configure your `.env`
5. Run `sudo composer update` from the projects root folder
6. From the projects root folder run `sudo chmod -R 755 ../AlbumGallery`
7. From the projects root folder run `php artisan key:generate`. This generates a unique key.
8. From the projects root folder run `php artisan migrate`. This initializes the database.
9. From the projects root folder run `composer dump-autoload`. This installs the default laravel dependencies.

#### View the Project in Browser
1. From the projects root folder run `php artisan serve`
2. Open your web browser and go to `http://localhost`