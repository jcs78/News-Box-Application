create table forumPosts(
	postID		INT 		AUTO_INCREMENT	PRIMARY KEY,
	postTitle	VARCHAR(255),
	postContent 	MEDIUMTEXT,
	postAuth	VARCHAR(255),
	postDate	DATETIME
)
