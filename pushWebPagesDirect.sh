#!/bin/bash

tar -czvf webPagesZip_Deploy.tar.gz webPages

mv ./webPagesZip_Deploy.tar.gz ./localZipStorage

scp ./localZipStorage/webPagesZip_Deploy.tar.gz jcs78@10.192.228.68:/home/jcs78/git/news-box-app/deploySystem/vmBuilds/buildsWebPages/buildLimbo

