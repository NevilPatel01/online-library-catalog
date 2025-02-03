# Online Library Catalog

## Description
The **Online Library Catalog** is a robust web application designed for efficient management of both physical and digital library resources. It offers an intuitive platform for users to browse and search through a curated collection of books and other media. Additionally, the system includes comprehensive administrative functionalities such as book category management, user account management, and more.

This project is developed using the **LAMP Stack** (Linux, Apache, MySQL, PHP) on the server side, complemented by **Bootstrap** for a responsive and user-friendly interface.

---

## Features

### Book Management (CRUD)
- **Create, Read, Update, and Delete Books**
  - Admins can manage the catalog by adding new books, editing existing details, or removing outdated entries.
  - Book details include:
    - Title
    - Author
    - Genre
    - Publication Date
    - Summary
    - Cover Image

- **Image Upload and Resizing**
  - Supports cover image uploads with automatic resizing for optimized display and storage.

### Advanced Search and Filtering
- **Search**
  - Users can search by keywords in titles, authors, or summaries.

- **Filters**
  - Refine searches using filters such as genre, author, and publication year.

### User Comments and Reviews
- **Comment System**
  - Registered users can comment on and review books.
  - Admins can moderate comments to maintain content quality.

### Admin Panel
- **User Management**
  - Admins can create, update, and deactivate user accounts.

- **Book Category Management**
  - Admins can manage genres, adding or removing categories as needed.

---

## Design and Usability

### Responsive Design with Bootstrap
- Fully compatible with desktops, tablets, and mobile devices.
- Clean, intuitive user interface.

### Consistent Navigation
- Easy-to-use menu structures for seamless navigation.

### Accessibility
- Designed to be inclusive and compatible with assistive technologies.

---

## Technology Stack

1. **Server-Side:** Apache with PHP for dynamic web content.
2. **Database:** MySQL for storing and managing book data, user information, and comments.
3. **Frontend:** Bootstrap for responsive design and user-friendly navigation.

### Hosting
- The application runs on an Apache web server, hosted on `localhost` for development.
- Deployable on any AMP-compatible server for production environments.

---

## Database Structure

### Overview
The database schema is designed to efficiently manage book data, user interactions, and system settings.

### Tables and Relationships

1. **Books Table**
   - `id` (INT, Primary Key, Auto Increment)
   - `title` (VARCHAR)
   - `author` (VARCHAR)
   - `genre_id` (INT, Foreign Key referencing Genres)
   - `publication_date` (DATE)
   - `summary` (TEXT)
   - `cover_image` (VARCHAR)
   - `created_at` (TIMESTAMP)
   - `updated_at` (TIMESTAMP)

2. **Genres Table**
   - `id` (INT, Primary Key, Auto Increment)
   - `name` (VARCHAR, Unique)
   - `created_at` (TIMESTAMP)
   - `updated_at` (TIMESTAMP)

3. **Users Table**
   - `id` (INT, Primary Key, Auto Increment)
   - `username` (VARCHAR, Unique)
   - `password` (VARCHAR)
   - `role` (ENUM: 'admin', 'user')
   - `created_at` (TIMESTAMP)
   - `updated_at` (TIMESTAMP)

4. **Comments Table**
   - `id` (INT, Primary Key, Auto Increment)
   - `book_id` (INT, Foreign Key referencing Books)
   - `user_id` (INT, Foreign Key referencing Users)
   - `content` (TEXT)
   - `created_at` (TIMESTAMP)
   - `moderated` (BOOLEAN)
   - `moderated_by` (INT, Foreign Key referencing Users)

### Table Relationships
- **Books to Genres:** Many-to-One (A book belongs to one genre; a genre can have many books).
- **Books to Comments:** One-to-Many (A book can have multiple comments).
- **Users to Comments:** One-to-Many (A user can post multiple comments).

---

## Installation and Setup

1. **Clone the Repository**
   ```bash
   git clone https://github.com/NevilPatel01/online-library-catalog.git
   ```

2.  **Set Up the Database**
    - Import the provided SQL file to your MySQL database.
    - Update the database credentials in the configuration file.

3.  Configure the Server

    - Ensure Apache and PHP are correctly installed and running.
    - Place the project files in your Apache htdocs directory (or equivalent).
    
4.  Run the Application
    Access the application via 
    ```bash
    http://localhost/librarycatalog
    ```

## License

This project is licensed under the MIT License.

