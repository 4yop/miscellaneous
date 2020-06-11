CREATE TABLE`queue` (
    id int(11) NOT NULL auto_increment primary key,
    taskphp varchar(128) NOT NULL default '',
    param text not null default '',
    status tinyint not null default 0,
    ctime timestamp NOT NULL default CURRENT_TIMESTAMP,
    KEY (ctime)
) ENGINE=InnoDBDEFAULT CHARSET=utf8;