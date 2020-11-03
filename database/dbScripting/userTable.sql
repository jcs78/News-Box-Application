create table newsBoxUsers(
	userID		INT		AUTO_INCREMENT	NOT NULL,
	username	VARCHAR(255)	NOT NULL	UNIQUE,
	password	VARCHAR(255)	NOT NULL,
	preferences	VARCHAR(255),

	PRIMARY KEY (userID)
)

