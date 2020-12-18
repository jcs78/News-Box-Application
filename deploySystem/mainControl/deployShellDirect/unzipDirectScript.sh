#!/bin/bash

scp jcs78@10.192.227.91:/home/jcs78/git/news-box-app/deploySystem/mainControl/zipStorageRemote/directToDeploy_zip.tar.gz ~/git/news-box-app/deploySystem/mainControl/unzipStorageRemote

tar -xvzf ~/git/news-box-app/deploySystem/mainControl/unzipStorageRemote/directToDeploy_zip.tar.gz -C ~/git/news-box-app/deploySystem/mainControl/unzipStorageLocal/

#mv ~/git/news-box-app/deploySystem/mainControl/unzipStorageRemote/zipTestDirect ~/git/news-box-app/deploySystem/mainControl/unzipStorageLocal

