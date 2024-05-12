# Multi ROle Login

This project is multi role login on the basis of User and Admin, Where admin have access to user detils and he can active deactive user

### Dependencies

-   Dependencies:

-   PHP Version: The project requires PHP 8.2.17 or higher.
    -   Guzzle HTTP: Version 7.2 or higher of Guzzle HTTP library.
    -   Intervention Image: Version 2.7 or higher for image manipulation.
-   Laravel Framework: Version 11.7.0 or higher, which is the Laravel framework itself.
-   Composer version 2.2.5
-   For cron Log: tail -f ~/logs/cron_log
-   Setup crontab -e
-   PHP: Ensure that you have PHP 8.1 or a higher version installed on your system.
-   Composer Version: 2.2.23

Composer: You need Composer, a PHP dependency manager, installed on your system. You can download and install it from the official Composer website: https://getcomposer.org/download/

Operating System: The Laravel project can be developed on various operating systems, including Windows, macOS, or Linux. It's compatible with Windows 10, macOS, and popular Linux distributions.

Web Server: To run a Laravel application, you may need a web server like Apache or Nginx. Laravel Sail provides a local development environment if needed.

Database: Laravel supports various databases (e.g., MySQL, PostgreSQL, SQLite, SQL Server). You should have the necessary database software installed and configured.

Node.js and NPM: If you plan to use Laravel Mix for asset compilation and frontend development, you should have Node.js and NPM (Node Package Manager) installed.

Before starting the Laravel project, ensure that you have these prerequisites in place and that you've installed Composer to manage the project's dependencies effectively. Additionally, consider setting up your web server and database according to your project's requirements.

### Installing

-   Open a Terminal or Command Prompt:

On Windows: Open the Command Prompt or Windows Terminal.
On macOS and Linux: Open the Terminal.
Navigate to the Directory Where You Want to Clone the Repo:

Use the cd command to navigate to the directory where you want to clone your repository. For example, to clone it into your home directory, you can use:
bash
Copy code

Clone the Repository:

Use the git clone command followed by the repository URL. Replace <repository_url> with your actual repository URL:
bash
Copy code

-   git clone <repository_url>
    For example, if your repository is hosted on Gitab, the URL might look like:

bash
Copy code

-   git clone https://gitlab.com/your-username/your-repository.git
    Authenticate (if required):

If your repository requires authentication (e.g., private repositories on GitHub), you may need to provide your username and password or a personal access token during the cloning process. Follow the prompts to provide the necessary credentials.
Wait for the Clone to Complete:

Git will begin cloning your repository. Depending on the size of the repository and your internet connection, this may take a moment. Once it's complete, you'll see a message indicating the successful clone.
Access Your Cloned Repository:

You can now access and work with the cloned repository in the directory where you initiated the clone. Use cd to enter the cloned repository's directory:
bash
Copy code

-   cd your-repository
-   composer install
-   npm i && npm run dev
-   cp .env.example .env
-   php artisan key:generate
-   php artisan migrate
-   php artisan db:seed
    Admin Login :
-   'email' => 'admin@weballures.com',
-   'password' => 'secret',
    Start Working:
