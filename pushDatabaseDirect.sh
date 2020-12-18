#!/bin/bash

tar -czvf databaseZip_Deploy.tar.gz database

mv ~/git/news-box-app/databaseZip_Deploy.tar.gz ~/git/news-box-app/localZipStorage

scp ~/git/news-box-app/localZipStorage/databaseZip_Deploy.tar.gz jcs78@127.0.0.1:/home/jcs78/git/news-box-app/deploySystem/vmBuilds/buildsDatabase/buildLimbo

