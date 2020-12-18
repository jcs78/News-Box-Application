#!/bin/bash

scp jcs78@127.0.0.1:/home/jcs78/git/news-box-app/deploySystem/mainControl/zipStorageRemote/directToDeploy_zip.tar.gz ~/git/news-box-app/deploySystem/mainControl/unzipStorageRemote

tar -xvzf ~/git/news-box-app/deploySystem/mainControl/unzipStorageRemote/directToDeploy_zip.tar.gz -C ~/git/news-box-app/deploySystem/mainControl/unzipStorageLocal/

