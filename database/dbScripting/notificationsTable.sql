CREATE TABLE notificationsTable(
	id		INT		AUTO_INCREMENT,
	userID		INT,
	notification	VARCHAR(255),
	status		INT		DEFAULT 0,
	date		DATETIME,
	PRIMARY KEY (id)
);
