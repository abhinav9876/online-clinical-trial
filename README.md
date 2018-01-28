
# First time setup

#### Clone and enter repository (please pull newest commits)
```
$ git clone https://github.com/abhinav9876/online-clinical-trial
$ cd br-puzz-app
```

#### Setup .env file
```
$ cp .env.example .env
```

#### Create docker images
```
$ cd docker
$ make
$ cd ..
```

#### Set up docker containers
```
$ RESET_DB=1 INIT_APP=1 docker-compose up # RESET_DB recreates the database. INIT_APP performs initial setup. You can stop using both variables after the setup.
```

#### Compile assets in 'watch' mode (css/js). Perform in new terminal window:
```
$ docker ps # view the "active" containers
$ docker exec -it puzztest_puzz_1 bash # login to the "app" container containing the laravel app
$ npm run watch
```

#### Open browser window
```
$ open http://localhost
```
# Subsequent app build (local)

#### Build docker containers
```
$ docker-compose up
```

#### Compile assets in watch mode
```
$ docker exec -it puzztest_puzz_1 bash
$ npm run watch
```

#### Open browser window
```
$ open http://localhost
```

# Troubleshooting

#### Generate a missing APP_KEY
```
$ docker exec -it puzztest_puzz_1 bash
$ php artisan key:generate
```

#### Recreate the db without `docker-compose up`
```
$ docker exec -it puzztest_puzz_1 bash
$ php artisan migrate:refresh
```

#### Reseed the db
```
$ docker exec -it puzztest_puzz_1 bash
$ php artisan db:seed
```
=======
# online-clinical-trial
>>>>>>> 46269a4985632b109721aeb7c378d3c155fc6152
