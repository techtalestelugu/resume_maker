# Resume Maker

A simple web application built with PHP that allows users to fill out a form with their personal details and automatically generates resumes using various templates.

## Features

- Easy-to-use interface for filling out personal details.
- Multiple professionally designed resume templates.
- Automatically generates resumes in downloadable formats (PDF/HTML).
- No coding skills required for users.

## Installation

Follow these steps to set up the project locally:

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/techtalestelugu/resume_maker.git
   cd resume_maker
   ```

2. **Set Up a Local Server**:
   - Use XAMPP, WAMP, or any other PHP-supported local server.
   - Place the project folder in the server's `htdocs` or equivalent directory.

3. **Database Configuration** (if applicable):
   - Import the `database.sql` file (if included) into your MySQL database.
   - Update the database configuration in the `config.php` file:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'resume_maker');
     ```

4. **Start the Server**:
   - Start your local server and navigate to `http://localhost/resume-maker` in your web browser.

## Usage

1. Open the application in your browser.
2. Fill out the form with your personal and professional details.
3. Choose a resume template.
4. Click the "Generate Resume" button to preview and download your resume.

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL (optional)

## Contributing

Contributions are welcome! Here's how you can help:

1. Fork the repository.
2. Create a feature branch: `git checkout -b feature-name`.
3. Commit your changes: `git commit -m 'Add new feature'`.
4. Push to the branch: `git push origin feature-name`.
5. Open a Pull Request.

## License

This project is licensed under the [MIT License](LICENSE).

## Acknowledgments

- Inspiration for the project.
- Any tools or libraries used.

---

Feel free to report issues or suggest features by opening an issue on the [GitHub repository](https://github.com/techtalestelugu/resume-maker).

Enjoy creating resumes effortlessly!
