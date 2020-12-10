create table forumPosts(
	postID		INT 		AUTO_INCREMENT	PRIMARY KEY,
	postTitle	VARCHAR(255),
	postContent 	MEDIUMTEXT,
	postAuthor	VARCHAR(255),
	postDate	DATETIME
)
