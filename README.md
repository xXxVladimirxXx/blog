## Simple blog

## Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/xXxVladimirxXx/blog.git
    cd blog/backend
    ```

2. **Install dependencies:**

    ```sh
    composer install
    ```

3. **Create a `.env` file:**

    Copy the `.env.example` file to `.env` and configure your database settings:

    ```sh
    cp .env.example .env
    ```

    Update the database configuration in the `.env` file:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```

4. **Generate an application key:**

    ```sh
    php artisan key:generate
    ```

5. **Run migrations:**

    ```sh
    php artisan migrate
    ```

6. **Seed the database (optional):**

    If you want to seed the database with some initial data, you can run:

    ```sh
    php artisan db:seed
    ```

7. **Start the development server:**

    ```sh
    php artisan serve
    ```

    The application will be available at `http://127.0.0.1:8000`.


8. **Run frontend:**

    ```sh
    cd ../frontend
    ```

    ```sh
    npm install
    ```

    ```sh
    npm run dev
    ```

    The frontend will be available at `http://127.0.0.1:5173`.