# Kohana-Propel #

Kohana-Propel is a Kohana 3.3 module that makes Propel ORM available in Kohana.


## Installation ##

* Include the library as submodule in `modules/`

* Enable the module

* Copy `MODULE/config/propel` to `APPLICATION/config/propel`, remove `.tpl` 
  suffix where applicable.


## Building files ##

The library includes a Minion task (`Propel_Build`) that rebuilds Propel files.

```bash
php index.php --task=Propel_Build
```

## Runtime use ##

The module will pick up your configured database connections and apply them to Propel,
just make sure your application (or a module) has a `config/database.php` file. 


## License ##

Released under the MIT license.
