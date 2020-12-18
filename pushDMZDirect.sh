#!/bin/bash

tar -czvf dmzZip_Deploy.tar.gz dmzAPI

mv ~/git/news-box-app/dmzZip_Deploy.tar.gz ~/git/news-box-app/localZipStorage

scp ~/git/news-box-app/localZipStorage/dmzZip_Deploy.tar.gz jcs78@127.0.0.1:/home/jcs78/git/news-box-app/deploySystem/vmBuilds/buildsDMZAPI/buildLimbo

