backupdir=/data/mysql_backup/
time=` date +%Y_%m_%d_%H_%M_%S `
db_user=用户名
db_pass=密码
mysqldump -u $db_user -p$db_pass --databases 数据库名 | gzip > /data/mysql_backup/backupname_$time.sql.gz
