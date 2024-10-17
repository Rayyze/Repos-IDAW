# User Management API

This API allows you to manage users in the database. You can create, read, update, and delete user records through simple HTTP requests.

## Table of Contents

1. [API Endpoints](#api-endpoints)
    - [GET Users](#get-users)
    - [POST New User](#post-new-user)
    - [PUT Update User](#put-update-user)
    - [DELETE User](#delete-user)
2. [Response Format](#response-format)
3. [Error Handling](#error-handling)
4. [CORS Headers](#cors-headers)

## API Endpoints

The API supports the following HTTP methods and URL structures:

### GET Users

**Endpoint:**  
`GET http://localhost/TP4/exo5/users.php`  
or  
`GET http://localhost/TP4/exo5/users.php/{id}` (where `{id}` is the user's ID)

**Description:**  
Fetches all users if no ID is specified. If an ID is provided, it fetches the user with that ID.

### POST New User

**Endpoint:**  
`POST http://localhost/TP4/exo5/users.php/{login}/{email}`

**Description:**  
Creates a new user with the specified login and email and return a json with the new user, including its ID.

### PUT Update User

**Endpoint:**  
`PUT http://localhost/TP4/exo5/users.php/{id}/{login}/{email}`

**Description:**  
Updates the user identified by `{id}` with the new login and email.

**error**
If a wrong ID or no ID is provided an error is returned along with an error code.

### DELETE User

**Endpoint:**  
`DELETE http://localhost/TP4/exo5/users.php/{id}`

**Description:**  
Deletes the user identified by `{id}`.

**Success**
Success is indicated by a message field in json format.

## Response Format

All API responses are in JSON format. Here are examples of successful and error responses:

### Successful Responses

**Creating a User:**
```json
    {
        "id": 1,
        "login": "test",
        "email": "test@test.com"
    }
```

**Fetching users**
```json
    [
        {
            "id": 1,
            "login": "test",
            "email": "test@test.com"
        },
        {
            "id": 2,
            "login": "test2",
            "email": "test2@test.com"
        }
    ]
```
