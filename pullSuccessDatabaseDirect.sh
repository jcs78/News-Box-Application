#!/bin/bash

scp jcs78@10.192.224.108:/home/jcs78/git/news-box-app/deploySystem/vmBuilds/buildsDatabase/buildSuccess/databaseZip_Deploy.tar.gz ./remoteZipStorage

rm -r database/

tar -xvzf ./remoteZipStorage/databaseZip_Deploy.tar.gz -C ./

