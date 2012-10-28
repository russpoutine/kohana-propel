propel.database = mysql
propel.project = model
propel.mysql.tableType = InnoDB
propel.addGenericAccessors = true
propel.addGenericMutators = true
propel.useDateTimeClass = true
propel.defaultTimeStampFormat = Y-m-d H:i:s
propel.defaultDateFormat = Y-m-d




#	Directory where the project files (`build.properties`, `schema.xml`,
#	`runtime-conf.xml`, etc.) are located.
#	If you use the `propel-gen` script, this value will get overridden by
#	the path from which the script is called.

propel.project.dir = .

#	The directory where Propel expects to find the XML configuration files.

propel.conf.dir = ${propel.project.dir}
propel.runtime.conf.file = runtime-conf.xml
propel.buildtime.conf.file = buildtime-conf.xml

#	The directory where Propel expects to find your `schema.xml` file.
	
propel.schema.dir = ${propel.project.dir}

#	The directory where Propel should output classes, sql, config, etc.
propel.output.dir = ${propel.project.dir}/../../

#	The directory where Propel should output generated object model classes.
propel.php.dir = ${propel.output.dir}/classes/
# NB This will be suffixed by the project name. I have tried setting the project name
# to (empty), but that made the paths in the classmap file look like '\om\User.php'
# and if that gets passed to 'require', require will think it's an absolute path
# and will fail. So until I find some better way to do this, I've removed the word
# 'model' word from the end of propel.php.dir and instead set it as project name.

#	The directory where Propel should output the compiled runtime configuration.
propel.phpconf.dir = ${propel.project.dir}

#	The directory where Propel should output the generated DDL (or data insert statements, etc.)
propel.sql.dir = ${propel.output.dir}/data

#	The name of the compiled configuration and classmap files
#	${propel.project}-conf.php
propel.runtime.phpconf.file = generated-conf.php

#	${propel.project}-classmap.php
propel.runtime.phpconf-classmap.file = generated-classmap.php

# *) 
