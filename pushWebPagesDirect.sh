#!/bin/bash

tar -czvf webPagesZip_Deploy.tar.gz webPages

mv ~/git/news-box-app/webPagesZip_Deploy.tar.gz ~/git/news-box-app/localZipStorage

scp ~/git/news-box-app/localZipStorage/webPagesZip_Deploy.tar.gz jcs78@127.0.0.1:/home/jcs78/git/news-box-app/deploySystem/vmBuilds/buildsWebPages/buildLimbo

