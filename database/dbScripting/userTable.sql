create table newsBoxUsers(
	userID		INT		AUTO_INCREMENT	NOT NULL,
	username	VARCHAR(255)	NOT NULL	UNIQUE,
	password	VARCHAR(255)	NOT NULL,

	sportsPref	BOOLEAN		DEFAULT 0,
	carsPref      	BOOLEAN		DEFAULT 0,
	politicsPref	BOOLEAN		DEFAULT 0,

	PRIMARY KEY (userID)
)

