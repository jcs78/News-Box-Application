create table newsBoxUsers(
	userID		INT		AUTO_INCREMENT	NOT NULL,
	username	VARCHAR(255)	NOT NULL	UNIQUE,
	password	VARCHAR(255)	NOT NULL,

	buiness		BOOLEAN		DEFAULT 0,
	entertainment	BOOLEAN         DEFAULT 0,
	generalPref     BOOLEAN         DEFAULT 0,
	health		BOOLEAN         DEFAULT 0,
	science		BOOLEAN         DEFAULT 0,
	sportsPref	BOOLEAN		DEFAULT 0,
	techPref      	BOOLEAN		DEFAULT 0,

	PRIMARY KEY (userID)
)

