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

#### Status Codes

200: OK. The standard success code and default option.
201: Object created. Useful for the store actions.
204: No content. When an action was executed successfully, but there is no content to return.
206: Partial content. Useful when you have to return a paginated list of resources.
400: Bad request. The standard option for requests that fail to pass validation.
401: Unauthorized. The user needs to be authenticated.
403: Forbidden. The user is authenticated, but does not have the permissions to perform an action.
404: Not found. This will be returned automatically by Laravel when the resource is not found.
500: Internal server error. Ideally you're not going to be explicitly returning this, but if something unexpected breaks, this is what your user is going to receive.
503: Service unavailable. Pretty self explanatory, but also another code that is not going to be returned explicitly by the application.

All of this Status code is set as required.

#### Test Cases 
    Test cases for all endpoints is written. To run test cases run this command
```shell
composer test
```
    