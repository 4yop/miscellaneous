backupdir=/data/mysql_backup/
time=` date +%Y_%m_%d_%H_%M_%S `
db_user=用户名
db_pass=密码
db_name=库名
db_backup=/data/mysql_backup/$db_name_$time.sql.gz
mysqldump -u $db_user -p$db_pass --databases $db_name | gzip > $db_backup
