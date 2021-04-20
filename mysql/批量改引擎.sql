SELECT CONCAT('ALTER TABLE ',table_name,' ENGINE=InnoDB;') FROM information_schema.tables

WHERE table_schema='ambari' AND ENGINE='MyISAM';