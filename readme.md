# Project Documentation

## Requirements

- Latest Docker version
- Windows Subsystem for Linux (WSL)

## Setup Instructions

1. Clone the repository:

   ```sh
   git clone <repository-url>
   ```

2. Open Command Prompt and navigate to the project folder:

   ```sh
   cd <project-folder>
   ```

3. Enter the bash console using the following command:

   ```sh
   bash
   ```

4. Build the Docker containers:

   ```sh
   make build
   ```

5. Access the website at:

   ```
   http://localhost:8080
   ```

6. Access PHPMyAdmin at:
   ```
   http://localhost:8081
   ```
   - Username: `user`
   - Password: `password`

## Make Commands

- `make clean`: Deletes all containers, volumes, and prunes the system.
- `make test`: Runs the unit tests.
- `make logs`: Shows the Docker logs.
- `make rebuild`: Rebuilds all containers and volumes.
- `make fresh`: Resets the database and rebuilds the containers.
