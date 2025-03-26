Expense Workflow App

This app is built in order to manage and submit workflow expenses, and to allow users to view their current and past expenses too. This app also allows for admins to review and accept/decline the expenses.

The app is separated into two sections, the employee and the admin sections. These sections house a shared dashboard section, with differing information appearing for employees than admins. Employees are able to submit and view their past and pending expenses, while the admins are able to review these expenses and approve or decline. When an expense is submitted, the admins are notified via email, and upon approval/rejection, the employees are notified accordingly too.

**Setup**

- When first cloning this repository down, please run all migrations using `php artisan migrate`
- Once migrations have ran, please seed the databases by running `php artisan db:seed`
- The migrations and seeders will have created two users, "Employee" and "Admin" users. Both of these have the password of `password123`. Use these to login and navigate the app.
- Emails are setup to simply log to the Laravel logs file, please enter in an email in the env file (detailed in the example) to get functionality from this.

**Extra functionality**

The additional functionality that I have added was that of a reporting export which can be used to filter by status, and return a bulk export of all expenses for admins. This can be accessed via the side navigation for admins.
