#!/bin/bash

tar -czvf dmzZip_Deploy.tar.gz dmzAPI

mv ./dmzZip_Deploy.tar.gz ./localZipStorage

scp ./localZipStorage/dmzZip_Deploy.tar.gz jcs78@10.192.224.108:/home/jcs78/git/news-box-app/deploySystem/vmBuilds/buildsDMZAPI/buildLimbo

