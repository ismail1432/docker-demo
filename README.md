# Docker-demo-for-beginners
This small application will show you how play with Docker for understand how does it works. I'll give you instruction and command to execute. Please follow all steps.
##### 1- Make sure yo have Docker on your machine ;-)
If not [install it](https://docs.docker.com/install/)

##### 2- Install project and go into
``git clone https://github.com/ismail1432/docker-demo.git``

then go inside directory

``cd docker-demo``

You will see a `docker` directory with `nginx` directory for vhost configuration, `php` with a Dockerfile to build a PHP image, and a `tools` diectory that contains 
another Directory for build an image with [composer](https://getcomposer.org/) and [node](https://nodejs.org/en/)

There is a [docker-compose](https://docs.docker.com/compose/) file to add more configuration and make our dev life easier

##### 3- What contains our configuration ?
We're going to create multiple container for test Docker. In detail we will install :
* PHP 7.2
* MySQL 
* Nginx
* Composer
* Node
* Yarn
* phpMyAdmin

##### 4- Build it !

###### Turn off your web server to avoid port configuration problem 

Inside the project, run :
``docker-compose build`` [build](https://docs.docker.com/compose/reference/build/)
The first time this command take a lot of time because we're installing all services mentioned before

##### 5- Up it !

After running the build command, you can see if your containers are working and alive
``docker ps`` [ps](https://docs.docker.com/engine/reference/commandline/ps/)
The result could be ![no container image](images/no-container.png?raw=true "No container")

We are going to wake up our containers with :

``docker-compose up -d`` [docker-compose up](https://docs.docker.com/compose/reference/up/)

You could see something like this :
 ![no container image](images/docker-up.png?raw=true "Docker up")
 
Now retry ``docker ps`` and you could see your containers alive :
 
 ![no container image](images/docker-ps-good.png?raw=true "Docker up")

##### 6- What's next ?

We are going to create a table in our MySQL container and put into some data

How to connect to MySQL container :

``docker-compose run mydockersql mysql -h mydockersql -u root -p``

It will ask a password, enter :

``dockpwd`` 

There is no magic the password was defined [here](https://github.com/ismail1432/docker-demo/blob/master/docker-compose.override.yaml#L23) feel free to change it but don't forget to run ``docker-compose up -d`` again and update [connexion.php](https://github.com/ismail1432/docker-demo/blob/master/public/connexion.php#L6).

The database already exits, defined in[here](https://github.com/ismail1432/docker-demo/blob/master/docker-compose.override.yaml#L25)

Create table and data :

```SQL
use docker-demo;
CREATE TABLE `docker_demo`.`langage` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(15) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
INSERT INTO `langage` (`id`, `name`) VALUES (NULL, 'php'), (NULL, 'java'), (NULL, 'javascript'), (NULL, 'ruby'), (NULL, 'c');
exit;
```

##### 7- Try our web server

Configure the vhost.conf file in docker/nginx directory. Change line 7 /var/www/html/docker-demo/public/ to /path/to/docker-demo/public/

then remerber that we defined port 1001 [here](https://github.com/ismail1432/docker-demo/blob/master/docker-compose.override.yaml#L7) so you can see our application at [localhost:1001](http://localhost:1001).

You should see ![script php](images/php-app.png?raw=true "hello from PHP")

Our script is connect with our database, feel free to remove any langage and go in you MySQL container to see if It deletes or not the selected langage.
If you delete all langage click on ``create data`` to recreate data

##### 8- The tools Container

The tools container contains composer, check it !
``docker-compose run tools composer -v`` you will see ![no container image](images/composer-version.png?raw=true "No container")

There is a [composer.json](https://github.com/ismail1432/docker-demo/blob/master/composer.json) file with [twig](https://twig.symfony.com/) as dependancies why not try to install it :-)

``docker-compose run tools composer install``

Now check the container PHP version :

``docker-compose run tools php -v`` 

You should see

![no container image](images/php-version.png?raw=true "No container")

If you have CLI PHP compare your version with it

``php -v``


Now say hello from Docker container :

``docker-compose run --rm tools php -r 'echo "Hello from Docker!\n";'``

Check NPM version

``docker-compose run tools npm -v`

##### 9- Access to phpMyAdmin

Go check phpMyAdmin [here](http://localhost:8080/)

End of the Game !

You can do more and more thing to play around docker, feel free to contact me if needed !

Made with <3 by [Ismail1432](www.smaine.me)


