#!/bin/bash

scp jcs78@10.192.224.108:/home/jcs78/git/News-Box-Application/deploySystem/vmBuilds/buildsWebPages/buildLimbo/webPagesZip_Deploy.tar.gz ./remoteZipStorage

rm -r webPages/

tar -xvzf ./remoteZipStorage/webPagesZip_Deploy.tar.gz -C ./

