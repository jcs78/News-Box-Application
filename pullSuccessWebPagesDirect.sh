#!/bin/bash

scp jcs78@10.192.228.68:/home/jcs78/git/news-box-app/deploySystem/vmBuilds/buildsWebPages/buildSuccess/webPagesZip_Deploy.tar.gz ./remoteZipStorage

rm -r webPages/

tar -xvzf ./remoteZipStorage/webPagesZip_Deploy.tar.gz -C ./

