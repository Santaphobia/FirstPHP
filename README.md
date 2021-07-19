FirstPHPCourseWork_GeekBrains: PHP(my framework), MySQL

Dump DB / Data

to work: You need to register in the configuration file nginx:


		location / {

			index            index.html index.php;
      
			try_files $uri $uri/ /index.php?$args;	
      
		}
