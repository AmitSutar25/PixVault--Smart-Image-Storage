# PixVault – Image Upload and Retrieval System

## 1. Project Overview

PixVault is a web-based image upload and retrieval application that allows users to upload images and retrieve them later by entering the name used during upload.

The project uses HTML for the user interface, PHP for server-side processing, Amazon S3 for image storage, and Amazon RDS MySQL for storing image names and their corresponding image URLs.

## 2. Objectives

- Allow users to upload images through a simple web interface.
- Store uploaded images in Amazon S3.
- Save image names and image URLs in an Amazon RDS MySQL database.
- Allow users to retrieve images by entering their saved image name.
- Provide a simple and responsive interface for uploading and finding images.

## 3. Technologies Used

- **HTML5** – Webpage structure and forms.
- **CSS3** – Styling and responsive design.
- **JavaScript** – Image preview and user-interface interactions.
- **PHP** – Upload processing, database operations, and image retrieval.
- **Amazon S3** – Image object storage.
- **Amazon RDS for MySQL** – Storage of image metadata.
- **Nginx** – Web server.
- **AWS SDK for PHP** – Communication between PHP and Amazon S3.
- **Git and GitHub** – Source code version control and project hosting.

## 4. System Architecture

The project follows this workflow:

1. The user opens the PixVault website.
2. The user selects an image and enters a name.
3. The PHP upload script uploads the image to Amazon S3.
4. The image name and S3 image URL are stored in Amazon RDS MySQL.
5. To retrieve an image, the user enters its name.
6. The retrieval script searches the MySQL database and displays the matching image.

**Architecture:**

User → HTML/CSS/JavaScript Website → PHP → Amazon S3

PHP ↔ Amazon RDS MySQL

## 5. Main Features

- Image upload through a web interface.
- Image preview before uploading.
- Image storage in Amazon S3.
- Image metadata storage in Amazon RDS MySQL.
- Image retrieval by name.
- Responsive user interface.
- Cloud-based image storage and database services.


## 6. Prerequisites

Before running the project, prepare:

- An AWS account.
- An Amazon S3 bucket.
- An Amazon RDS for MySQL database.
- An EC2 instance or another server configured to run PHP.
- Nginx or another compatible web server.
- PHP with the required extensions.
- Composer and the AWS SDK for PHP, if the project uses Composer.
- Git installed on your computer or server.

## 7. Database Setup

Create a MySQL database and a table for image metadata. The following example matches the `name` and `url` columns expected by the retrieval script.

CREATE DATABASE myappdb;

USE myappdb;

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    url TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


If your database and table already exist, verify that their column names match the PHP scripts before running these queries.

## 8. AWS Configuration

1. Create an S3 bucket to store images.
2. Create an RDS MySQL database.
3. Configure security groups so the web server can reach the database on port `3306`.
4. Configure PHP with the AWS SDK for PHP.
5. Give the application permission to upload objects to the required S3 bucket.
6. Configure database connection settings securely.
7. Ensure the image URLs returned by the application are accessible to authorized users. Avoid making private images publicly accessible unnecessarily.

Use an IAM role for an EC2-hosted application where possible. Do not store AWS access keys or database passwords in this repository.

## 9. How to Use the Application

### Upload an image

1. Open the PixVault homepage.
2. Enter a name for the image.
3. Select an image file.
4. Click **Upload Image**.
5. The PHP backend stores the image in S3 and records its name and URL in MySQL.

### Find an image

1. Open the homepage.
2. Enter the same name used during upload.
3. Click **Find My Image**.
4. The application searches the database and displays the matching image, if found.

## 10. Security Considerations

- Do not commit AWS access keys, database passwords, or private configuration files.
- Use IAM roles and least-privilege permissions.
- Validate uploaded file types and sizes on the server.
- Use prepared SQL statements to protect database queries.
- Keep private images private and use suitable access controls.
- Use HTTPS when deploying the website publicly.

## 11. Future Enhancements

- User registration and login.
- User-specific image galleries.
- Image deletion and renaming.
- Pagination for image search results.
- Improved image validation and upload limits.
- Temporary pre-signed S3 URLs for private image access.
- CloudWatch monitoring and application logging.

## 12. Conclusion

PixVault demonstrates how a web application can integrate PHP with AWS cloud services to store images in Amazon S3 and manage image metadata in Amazon RDS MySQL. It is a practical beginner-level project for learning cloud storage, database connectivity, web development, and AWS deployment.
