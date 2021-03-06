create table articleTable(
	articleID	INT 		AUTO_INCREMENT,
	prefName	VARCHAR(255),
	sourceName 	VARCHAR(255),
	article 	VARCHAR(255),
	articleTitle 	VARCHAR(255),
	description 	MEDIUMTEXT,
	url 		MEDIUMTEXT,
	urlToImage 	VARCHAR(255),
	publishedAt 	VARCHAR(255),
	content 	MEDIUMTEXT,
	PRIMARY KEY(articleID)
);
