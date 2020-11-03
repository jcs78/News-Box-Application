#!/bin/bash

sudo mysql -u root testDB < articleCommentsTable.sql

sudo mysql -u root testDB < articleTable.sql

sudo mysql -u root testDB < forumReplyTable.sql

sudo mysql -u root testDB < forumTable.sql

sudo mysql -u root testDB < userTable.sql
