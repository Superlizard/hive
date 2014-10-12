HIVE
====

Hi-fi prototyp – MAMN25

Installation
====

1. Se till att ha Composer (https://getcomposer.org/), PHP (med mcrypt- och fileinfo-extensions) samt MySQL installerat.
2. Klona hela repot och cd:a in i root-mappen. 
3. Kör en composer install --dev och vänta tills allt är klart. 
4. För att installera alla nödvändiga tabeller och seeda databasen, kör ./migrate.sh
5. Poff! Nu bör allt fungera som det ska. Routen för HIVE är /hive. 