Step 1: Clone the GitHub Repository
```bash
git clone https://github.com/mdhedayet/test-job.git
```

Step 2: Navigate to the Project Directory
```bash
cd test-job
```
Step 3: Install Composer Dependencies
```bash
composer install
```
Step 4: Install NPM Dependencies
```bash
npm install
```
Step 5: Copy Environment File
```bash
cp .env.example .env
```
Step 6: Generate Application Key
```bash
php artisan key:generate
```
Step 7: Configure Database
Edit the .env file and set up your database connection details.

Step 8: Run Migrations
```bash
php artisan migrate
```
Step 9: Run Seed
```bash
php artisan db:seed
```
Step 10: Run the Development Server
```bash
php artisan serve
```
Step 11: Compile Assets
```bash
npm run dev
```
Visit http://127.0.0.1:8000 in your browser, and you should see the Laravel application.
