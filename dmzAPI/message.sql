SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS 'message' (
	'id' int(11) NOT NULL,
	'name' varchar(255) NOT NULL,
	'message' varchar(255) NOT NULL,
	'status' int(2) NOT NULL DEFAULT '0',
	'cr_date' datetime NOT NULL )

ALTER TABLE 'message'
ADD PRIMARY KEY ('id');

ALTER TABLE 'message'
MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT;
