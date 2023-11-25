# Trivia App

To run this application, follow the following steps:

1. Install the required dependencies by typing the following command in your terminal:
   ```bash
   composer install.
2. Configure Database Connection: Create a .env file in the project root and configure it for the database connection. Provide the necessary information such as database name, username, password, etc.
3. Generate Application Key
    ```bash
    php artisan key:generate
4. Run Migrations: Execute the database migrations to set up the necessary tables.
    ```bash
    php artisan migrate
5. Start the Development Server: Launch the development server with the following command:
    ```bash
    php artisan serve
