FirstPHPCourseWork_GeekBrains: PHP(my framework), MySQL

Dump DB / Data

Config DB - /config/config.php

To work, you need to register in the nginx configuration file:


		location / {
			index            index.html index.php;
			try_files $uri $uri/ /index.php?$args;
		}
