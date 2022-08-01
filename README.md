# About the project
- Junior Developer Test Task from Scandiweb
- This is Public version of my other private repo
- [Deployed Website](https://scandiweb-test.onrender.com/)

The project has two parts
- [Front-end](frontend/README.md) built with `React.js`, running on `port 8080`
- [Back-end](backend/README.md) built with `pure-php`, running on `port 8080`

# Tech Stack
- Docker
- React
- php

# How to run the project
- Create .env file at the root of the project
- Then change, the [.env](/.env) file to point to the right mysql instance
- Change where the frontend is talking with [Front-end-config](/frontend/src/Config/Api.js)
```shell
docker build -t scandiwebtest .
docker run -p 8080:80 scandiwebtest:latest
```
## To run with docker compose(not used in my production)
> The docker compose includes mysql+phpmyadmin images
- Create .env file at the root of the project
- Then Change, [.env](/.env) to point to the mysql container's property
- Change where the frontend is talking with [Front-end-config](/frontend/src/Config/Api.js)
```shell
docker compose up -d --build
```

# End points

## To access page
- `http://localhost:8080`

## Backend endpoints
- POST `http://localhost:8080/api/products/create.php`
- GET `http://localhost:8080/api/products/read.php`  #read all products
- GET `http://localhost:8080/api/products/read.php?sku=xyz` #read a product with sku xyz
- DELETE `http://localhost:8080/api/products/delete.php`
