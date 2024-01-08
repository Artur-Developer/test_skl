# SKL Test Project

This project is a test assignment for SKL Group.

## Installation

1. Build Docker containers:

    ```bash
    docker-compose build
    ```

2. Start Docker containers:

    ```bash
    docker-compose up -d
    ```

3. Enter the PHP container:

    ```bash
    docker-compose exec -u 0 php bash
    ```

4. Install dependencies using Composer:

    ```bash
    composer install
    ```

5. Run database migrations:

    ```bash
    php yii migrate
    ```

## Currency Update Script

To update currency rates, run the following command:

   ```bash
   php yii currency/update
   ```
## Access URLs
- **Git Repository:** [https://github.com/Artur-Developer/test_skl](https://github.com/Artur-Developer/test_skl)
- **Web Application:** [http://project_skl.localhost/](http://project_skl.localhost/)
- **API:** [http://project_skl.localhost:81/v1/](http://project_skl.localhost:81/v1/)
- **Swagger Documentation:** [http://project_skl.localhost:8080/](http://project_skl.localhost:8080/)