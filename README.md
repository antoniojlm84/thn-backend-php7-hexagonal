## THN BACKEND TEST
-- Antonio de Lucas --

### About the project

- Symfony 5.3 over a docker image with a LAMP enviroment (debian, php 7.3, mysql 8.x).
- Hexagonal architecture with DDD and SOLID good practices.
- API request and responses with JWT auth validation.
- Make FILE to install docker images and install symfony dependences easily with some fixtures.

### Download project


### Configuring project

We have to edit our hosts file to add the following mapping to it (Linux → /ect/hosts):

127.0.0.1       thn-backend-test.local

Install project (get docker running and install symfony vendors)

We have to move to the project dir and type this commands in the console:

```shell
make up
make install-thn-backend-test
```

1 - make up: starts our docker containers system

2 - make install-thn-backend: creates and load some fixtures to the DB

### Endpoints
Login - get JWT token

The enpoint api/token has a public access so we can request as many tokens as we want.

http://thn-backend-test.local/api/token?user=user_admin@thn.com&password=password

Method: POST
Params:
user: user_admin@thn.com
password: password

This endpoint will give us a token (jwt_token) that we have to use with each Api request. The token is a Jason Web Token and would be like this:

```json
{
"token_type": "bearer",
"access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MzMxMDMxNDUsImV4cCI6MTYzMzI3NTk0NSwidXNlcm5hbWUiOiJ1c2VyX2FkbWluQHRobi5jb20ifQ.tFXgfRgHVrhfIlxmJS2tfsgpoBJ6Wad6P3h0WVBxAzfFfqZ20QqMJEGNhjYjsguFQexdm2csfAfRrYu1ISZBtL_S_sTlRvLQ0-h4L3UOufvltXLYpza_Z6cdsxmMmh1_t52wQt8-4BDeOFxODo66KvJy7XFi42C8BZVcQCimKfij-Bs_JlEcqs1Ik1yqEzBClo37omgCzRF9wj3nnwgNftWLz-QAthay5PpEY5puP64qHQtrker-3q2tOxuI2jG6-d1PNsUuWwprfIyAzDm6_j1bVhGwZ4MM7ifwaU4Z_JwBAqFaUis6m1zmY7ZGlV1h_ZSI7izwfD9XrENOoy6VRysqynHPssA8LvyTtZ6eXIpiRklHwfA7p1Jsu1MGxKOruYg7g82Tqs_KqYPBBNDLd7QSBR6CpzbuJX23TDaa9hsnuXZJIovAfm-wKzhelFj54NwkTodgx6YiE8iS5M43EAytp67ph5oBjhFXsyGoGL24stfghRHT7mOPW_lYj-GB5WsKCrwgMZY-SQSsdcl0shqQjOOLee5P8oODHR_ukw0-XjBYfNK0F-C_I1TEmTOBY5Xi9zsbXBNtNW3zEsJINf-z_HW5QwR_nhTi-6XLYWnFBZavATBrtn4s2xRm5ujNpsxBJGElAiYQwYwfwfe0oqNI8X20hj0WMY5IfqgCOn8",
"expires_in": 1633275945
}
```

#### Required test endpoints

###### Hotel details

http://thn-backend-test.local/api/hotels/2f58f818-4b19-4b09-a2fd-461987f78151

Method: GET

Headers:

auth: {{access_token}}

###### Hotel registered room list

http://thn-backend-test.local/api/hotels/rooms

Method: GET

Headers:

auth: {{access_token}}

###### Clients rooms booked

http://thn-backend-test.local/api/clients/booked-rooms

Method: GET

Headers:

auth: {{access_token}}
