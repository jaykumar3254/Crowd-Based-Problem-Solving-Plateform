Crowdsource Community Platform is a web application designed to let users post problems, share solutions, and upvote helpful responses within a collaborative community. Built using PHP, MySQL, HTML, CSS, and JavaScript, it features secure user registration, login, personalized dashboards, and easy-to-navigate content management. This project aims to empower students, hobbyists, and professionals to engage, share knowledge, and solve everyday challenges together.

How to Run Locally
Install XAMPP (or any Apache + MySQL stack).

Clone or download this repository.

Copy all project files into the htdocs folder (inside your XAMPP installation directory).

Start Apache and MySQL from the XAMPP control panel.

Open phpMyAdmin (http://localhost/phpmyadmin), create a database named exactly as specified in your config (cspsp or your chosen name).

Import the provided .sql database file found in the repository to create all required tables and initial data.

Visit http://localhost/{your-folder-name} in your browser.

Register a new user and start using the platform (login, post problems, add solutions, upvote, and browse content).

Note: Make sure your database credentials in db.php and other config files match your local setup, usually:

Host: localhost

Username: root

Password: (leave blank by default in XAMPP)​​

This description and setup guide will help users quickly understand your project and launch it on their own system.
