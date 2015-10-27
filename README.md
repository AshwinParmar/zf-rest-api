# RESTful Applications with Zend Framework + AngularJS + Google Material Design demo.

This is an **example** to demonstrate how to create REST API with Zend framework Ver. 1.x and consume Web services with AngularJS + Google Material design.

Setting Up Your Database
=====================
I have use MySql as database server, you can import database dump from directory `sql` having filename `test.sql`.

Create one database from MySQL Server before import sql dump.

Import using command line:
> mysql -h localhost -u root -p database_name < /path_to_sql_dir/test.sql

Setting up database configuration in `/application/configs/application.ini` file and update following parameters.

    resources.db.adapter = "PDO_MYSQL"
    resources.db.params.dbname = "test"
    resources.db.params.host = "localhost"
    resources.db.params.username = "root"
    resources.db.params.password = ""
    resources.db.params.charset  = "UTF8"
    resources.db.isDefaultTableAdapter = true

Setting Up Your VHOST
=====================

The following is a sample VHOST you might want to consider for your project.

    <VirtualHost *:80>
       DocumentRoot "/PATH-TO-zf-rest-api/public"
       ServerName zf-angular.local
    
       # This should be omitted 
       # in the production environment
       SetEnv APPLICATION_ENV development
    
       <Directory "/PATH-TO-zf-rest-api/public">
           Options Indexes MultiViews FollowSymLinks
           AllowOverride All
           Order allow,deny
           Allow from all
       </Directory>
    
    </VirtualHost>

Open `hosts`file, and put entry at bottom of the file.
for Windows: `C:\Windows\System32\Drivers\etc\hosts`
for Linux: `/etc/hosts`

    127.0.0.1		zf-angular.local

REST API Endpoint
=====================

> http://zf-angular.local/api
> http://zf-angular.local/api/foo

Supported Methods:

**GET	list all the values from foo table.**
Request:
 

> http://zf-angular.local/api/foo

  **Response: (Default XML)**

    <?xml version="1.0" encoding="utf-8"?>
    <response>
        <message>Listing of all values.</message>
        <results>
            <result>
                <id>1</id>
                <name>first_name</name>
                <value>Ashwin</value>
            </result>
            <result>
                <id>2</id>
                <name>last_name</name>
                <value>Parmar</value>
            </result>
            <result>
                <id>3</id>
                <name>city</name>
                <value>Jetpur</value>
            </result>
            <result>
                <id>4</id>
                <name>country</name>
                <value>India</value>
            </result>
            <result>
                <id>5</id>
                <name>job</name>
                <value>Software Engineer</value>
            </result>
            <result>
                <id>6</id>
                <name>temp_path</name>
                <value>/tmp</value>
            </result>
            <result>
                <id>7</id>
                <name>A</name>
                <value>B</value>
            </result>
            <result>
                <id>8</id>
                <name>A1</name>
                <value>B1</value>
            </result>
        </results>
        <total>8</total>
    </response>


**Request: (JSON)**
>  http://zf-angular.local/api/foo?format=json

  **Response: (For JSON)**
 

     {
      "message": "Listing of all values.",
      "results": [
        {
          "id": "1",
          "name": "first_name",
          "value": "Ashwin"
        },
        {
          "id": "2",
          "name": "last_name",
          "value": "Parmar"
        },
        {
          "id": "3",
          "name": "city",
          "value": "Jetpur"
        },
        {
          "id": "4",
          "name": "country",
          "value": "India"
        },
        {
          "id": "5",
          "name": "job",
          "value": "Software Engineer"
        },
        {
          "id": "6",
          "name": "temp_path",
          "value": "/tmp"
        },
        {
          "id": "7",
          "name": "A",
          "value": "B"
        },
        {
          "id": "8",
          "name": "A1",
          "value": "B1"
        }
      ],
      "total": 8
    }

**GET Request with param**

> curl -X GET http://zf-angular.local/api/foo/id/1

**GET Response**  

    <?xml version="1.0" encoding="utf-8"?>
    <response>
        <id>1</id>
        <results>
            <result>
                <id>9</id>
                <name>first_name</name>
                <value>Ashwin</value>
            </result>
        </results>
    </response>


**POST Request:**

> curl -X POST --data "name=value1&value=value2"
> http://zf-angular.local/api/foo

**POST Response:**

    <?xml version="1.0" encoding="utf-8"?>
    <response>
    	<params>
    		<module>api</module>
    		<controller>foo</controller>
    		<action>post</action>
    		<name>value1</name>
    		<value>value2</value>
    		<format>xml</format>
    	</params>
    	<message>Resource 'value1' (9) Created!</message>
    </response>

**PUT Request:**

> curl -X PUT --data "name=value1&value=value2&id=9"
> http://zf-angular.local/api/foo

**PUT Response:**

    <?xml version="1.0" encoding="utf-8"?>
    <response>
        <message>Resource #1 Updated</message>
    </response>

**DELETE Request:**

> curl -X DELETE http://zf-angular.local/api/foo/id/9

**DELETE Response:**

    <?xml version="1.0" encoding="utf-8"?>
    <response>:
        <id>9</id>
        <message>Resource #1 Deleted</message>
    </response>



# Refferences:
* https://github.com/ahmadnassri/restful-zend-framework
* https://github.com/ahmadnassri/restful-zend-framework
