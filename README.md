# Lumen Skeleton

This repository contains the Lumen skeleton which is run with Docker.

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
