#!/bin/bash

tar -czvf directToDeploy_zip.tar.gz zipTestDirect

mv ~/git/news-box-app/deploySystem/mainControl/deployShellDirect/directToDeploy_zip.tar.gz ~/git/news-box-app/deploySystem/mainControl/zipStorageLocal

scp ~/git/news-box-app/deploySystem/mainControl/zipStorageLocal/directToDeploy_zip.tar.gz jcs78@127.0.0.1:/home/jcs78/git/news-box-app/deploySystem/mainControl/zipStorageRemote

