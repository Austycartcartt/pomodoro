# Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose build --no-cache` to build fresh images
3. Run `docker compose up --pull always -d --wait` to start the project
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker compose down --remove-orphans` to stop the Docker containers.

## Implementation

This is a backend API for a Pomodoro timer.

When a Pomodoro session and timer are created, a cron job will run every minute to check which sessions are complete. When a Pomodoro session is complete, the timer will be set to complete, triggering a Mercure event signaling that the task is done.

Setting up the API in this manner simplifies the frontend logic to only require CRUD operations and to listen for when a timer is complete.