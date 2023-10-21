

## Talent Task


### Steps To Install The  Project

- `sudo  git clone https://github.com/ahmedisa106/talent_task.git`


-  `cd /talent_task`


-  `sudo  cp .env.example .env`


-  `You must configure your .env file and put your database credentials`


- `you must configure your Email Service Provider to receive the Email`


- `you must configure .env QUEUE_CONNECTION to be redis insteadof sync`
### Run The Following Commands In Terminal
`composer install` to  install  all dependencies

`php artisan key:generate` to  generate app_key

`php artisan migrate --seed` to publish all migration and seeds files

`php artisan serve` to serve the project

`php artisan queue:work` to run queues




