# Project Skeleton

This repository contains the project skeleton which is run with Docker.

## System Requirements

- Docker ^4.x
- Default ports [8082 (app) and 3308 (DB)] must be available, otherwise, it needs adjustment on the exposed ports.

## Setup

- Copy environment files by running `cp .env.example .env`.
- Run `docker-compose up -d`.
- If there are no issues, your app should run `http://localhost:8082`.
- Your database should run on port `3308`. Here are the default credentials:

```
HOST=localhost
PORT=3308
USERNAME=root
PASSWORD=ayp-group
```
-------------------------------------------------
1. Database design
- Workers table:
  - fist_name: string, max length is 255, required
  - last_name: string, max length is 255, required
  - email: string, max length is 255, unique, required
- Employments table:
  - worker_id: id of worker
  - company_name: string, max length is 255, required
  - job_title: string, max length is 255, required
  - start_date: date, required
  - end_date: date, nullable
* Relationship between worker and employment: One to Many

2. My extra work
   - API Design
     - POST  /worker
       - Description: Create a new worker 
       - Params: 
         - first_name: first name of worker
         - last_name: last name of worker
         - email: email of worker
       - Return: JSON data
`        {
         "data": {
          "id": 1
          }
          } `
       
     - GET    /worker      
        - Params: None
        - Return: JSON list of worker as
     - POST    /employment 
       - Description: Create a new employment
       - Params:
           - email: email of worker
           - company_name: name of employer
           - job_title: position of worker
           - start_date: the date, employment start
       - Return:
`          {
         "data": {
         "id": 1
         }
         }`
     
     - PATCH       /employment 
       - Description: Update a new employment
       - Params:
         - id: id of employment
         - end_date: the date, employment end
       - Return:
   `      {
         "data": {
         "id": 1
         }
         } `
   - Source
     - Controller:
       - App\Http\Controller\WorkerController.php
       - App\Http\Controller\EmploymentController.php
     - Rule:
       - App\Rule\EndDateMustBeAfterStartDate.php
       - App\Rule\WorkerMustBeUnemployed.php
     - Services:
       - App\Services\WorkerService.php
       - App\Services\EmploymentService.php
     - Database:
       - App\database\migrations\2022_06_19_143432_create_worker_table_202206119.php
       - App\database\migrations\2022_06_19_202300_create_employment_table_20220619.php
     - App\Exceptions:
       - Modify the `render() `function to return JSON when system throw ValidationException.  
