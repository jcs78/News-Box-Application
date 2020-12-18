#!/bin/bash

tar -czvf directToDeploy_zip.tar.gz zipTestDirect

mv ~/git/news-box-app/deploySystem/mainControl/deployShellDirect/directToDeploy_zip.tar.gz ~/git/news-box-app/deploySystem/mainControl/zipStorageLocal

scp ~/git/news-box-app/deploySystem/mainControl/zipStorageLocal/directToDeploy_zip.tar.gz jcs78@10.192.227.91:/home/jcs78/git/news-box-app/deploySystem/mainControl/zipStorageRemote

