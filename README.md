create database d8;
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER,
CREATE TEMPORARY TABLES, LOCK TABLES ON d8.*
TO 'd8'@'172.16.219.1' IDENTIFIED BY 'd8';

drush site-install standard --db-url=mysql://d8:d8@jessie.dev/d8 --site-name=d8.dev --account-name=webmaster --account-pass=webmaster --notify

drush site-install standard --db-url=mysql://d8_dev:d8_dev@jessie.dev/d8_dev --site-name=d8.dev --account-name=webmaster --account-pass=webmaster --notify

sudo chgrp -R www-data sites/default/files
sudo chmod g+w -R sites/default/files

http://dev.mysql.com/doc/refman/5.5/en/innodb-multiple-tablespaces.html

SHOW ENGINE INNODB STATUS
[mysqld]
innodb_file_per_table


/etc/fstab
tmpfs	/var/lib/mysql/d8_dev	tmpfs	defaults,size=512m	0	0

time sudo -u www-data php ./core/scripts/run-tests.sh --url http://d8.dev/ --color --all --concurrency 4

time sudo -u www-data php ./core/scripts/run-tests.sh --url http://d8.dev/ --dburl mysql://d8_dev:d8_dev@jessie.dev/d8_dev --sqlite /home/andribas/www/cache/test.sqlite  --color --all --concurrency 4 --die-on-fail
