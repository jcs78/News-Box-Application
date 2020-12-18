#!/bin/bash

scp jcs78@10.192.224.108:/home/jcs78/git/news-box-app/deploySystem/vmBuilds/buildsDMZAPI/buildLimbo/dmzZip_Deploy.tar.gz ./remoteZipStorage


rm -r dmzAPI/

tar -xvzf ./dmzZip_Deploy.tar.gz -C ./

