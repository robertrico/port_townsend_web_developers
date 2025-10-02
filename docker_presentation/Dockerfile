# This line tells Docker to pull the base image php:7.4-apache from Docker Hub. This image includes PHP 7.4 and Apache configured to work together, providing the necessary environment for our PHP application.
FROM php:7.4-apache

# This command copies files from the src directory on our host machine into the /var/www/html/ directory inside the container, which is Apache's default directory for serving content.
COPY src/ /var/www/html/


# This exposes port 80 on the container, allowing the Apache server to receive requests from outside the Docker environment.
EXPOSE 80

# To build our Docker image, we run this command in the terminal.
# docker build -t pt-php-app .

# -t pt-php-app tags our image with the name pt-php-app
# . tells Docker to use the Dockerfile in the current directory. Docker then executes each command in the Dockerfile to assemble the image.

# docker run -d -p 8080:80 pt-php-app

#With our image ready, we can now run it as a container.
# --name is the name of the container. If we didn't specify a name, Docker would generate a random one.
# The -d option runs the container in detached mode, allowing us to continue using the terminal.
# -p 8080:80 maps port 80 of the container to port 8080 on our host.This setup means we can access the PHP server via port 8080 on our local machine

# http://localhost:8080