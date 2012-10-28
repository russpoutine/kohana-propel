# Kohana-Propel #

Kohana-Propel is a Kohana 3.3 module that makes Propel ORM available.


## Installation ##

* Include the library as submodule in `modules/`

* Enable the module

* Copy MODULE/config/propel to APPLICATION/config/propel, remove `.tpl` 
  suffix where applicable.


## Building files ##

The library includes a Minion task (`Propel_Build`) that rebuilds Propel files.

* `php index.php --task=Propel_Build`


## License ##

Released under the MIT license.
