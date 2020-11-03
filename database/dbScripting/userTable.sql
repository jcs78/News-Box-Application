create table newsBoxUsers(
	userID		INT		AUTO_INCREMENT	NOT NULL,
	username	VARCHAR(255)	NOT NULL	UNIQUE,
	password	VARCHAR(255)	NOT NULL,

	business	BOOLEAN		DEFAULT 0,
	entertainment	BOOLEAN         DEFAULT 0,
	health		BOOLEAN         DEFAULT 0,
	science		BOOLEAN         DEFAULT 0,
	sports		BOOLEAN		DEFAULT 0,
	tech      	BOOLEAN		DEFAULT 0,

	PRIMARY KEY (userID)
)

