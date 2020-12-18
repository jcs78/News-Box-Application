#!/bin/bash

tar -czvf databaseZip_Deploy.tar.gz database

mv ./databaseZip_Deploy.tar.gz ./localZipStorage

scp ./localZipStorage/databaseZip_Deploy.tar.gz jcs78@10.192.224.108:/home/jcs78/git/news-box-app/deploySystem/vmBuilds/buildsDatabase/buildLimbo

