## Coding Test - REST API
This is a coding test for ....

### Announcement
This Project is Docker ready.

### Requirements
* Docker
* Docker Compose


### Installation

no extra panic to install this project just run this command

```shell
./pusku build
```

to view author details run this command

```shell
./pusku about
```


#### What contains with Docker?

- PHP 7.1.3
- Nginx
- MySQL 5.7
- Redis
- Supervisor
- Git
- GD Library
- Zip Library

So you no need to Install PHP, no need to manage queue, task scheduler wil automatically run in background, worker and database system with auto migration and seeding.

open browser and goto http://localhost:8112/. 


#### Features
- GET /values
    - http://localhost:8112/api/posts
    - return all values from the presistent store & will reset the TTL.

- GET /values/key1,key2
    - http://localhost:8112/api/posts/1,2,3
    - return values that match the keys from the presistent store & will reset the TTL.

- POST /values
    - http://localhost:8112/api/posts
    - store values.

- PATCH /values
    - http://localhost:8112/api/posts/1
    - update values of which match the keys from the presistent store & will reset the TTL.

- DELETE/values
    - http://localhost:8112/api/posts/1
    - delete values that match the keys from the presistent store.


### Task Scheduler

This task scheduler remove all values stored over more than 5 minutes

```shell
$schedule->call(function () {
    Post::where('updated_at', '<=', Carbon::now()->subMinutes(5)->toDateTimeString())->delete();
})->everyMinute();
```