🔹 Deployment Process

1️⃣ Local Application

PHP + MySQL full-stack web application was initially running on my local laptop.
The application and database were working in the local environment.

2️⃣ Exported MySQL Database

Exported the complete MySQL database from the local system into a .sql file.

3️⃣ GitHub Repository

Pushed the application source code and Dockerfile to GitHub.
Used Git/GitHub for source-code version control.

4️⃣ Created AWS RDS MySQL

Created a managed MySQL database instance using Amazon RDS.
Configured the database for the AWS environment.

5️⃣ Imported SQL Data into RDS

Imported the exported .sql database file into the RDS MySQL database.
This migrated the existing application data from the local environment to AWS.

6️⃣ Configured Application for RDS

Updated db_config.php with the RDS database endpoint and credentials.
The PHP application was then connected to the AWS RDS database instead of the local MySQL database.

7️⃣ Removed Localhost Dependencies

Updated application configuration and app.js where the application was using localhost.
Configured the application to work with the EC2-hosted environment.

8️⃣ Dockerized the Application

Created a Dockerfile using PHP + Apache.
Built a Docker image from the application source code.

9️⃣ Deployed Container on EC2

Created an AWS EC2 Linux server.
Installed and configured Docker.
Created a container from the Docker image.
Mapped the container's Apache port to EC2 port 8080.

🔟 Live Application on AWS

The application is now accessible through the EC2 public IP.
Application and database are separated:
EC2 → Docker + Apache + PHP
RDS → MySQL Database
🏗️ Architecture

Local Laptop
⬇️ Export MySQL Database
⬇️ .sql file + Application Code
⬇️ GitHub
⬇️ AWS
➡️ EC2 (Linux) → Docker → Apache → PHP Application
↕️ Secure Database Connection
➡️ Amazon RDS (MySQL) → Application Data
⬇️

🛠️ Technologies Used

🌐 AWS  
🌐 EC2 
🌐 RDS 
🌐 Linux 
🌐 Docker 
🌐 Apache 
🌐 PHP  
🌐 MySQL 
🌐 Git  
🌐 GitHub

💡 What I Learned

Moving the application from local environment to AWS helped me understand a real-world deployment workflow:

✅ Cloud-based application hosting
✅ Managed database with Amazon RDS
✅ Docker containerization
✅ Linux server administration
✅ Application-to-database connectivity
✅ Environment/configuration management
✅ Git/GitHub based deployment workflow
✅ Separation of application and database layers
✅ Practical AWS + DevOps deployment experience