#!/bin/bash

scp jcs78@10.192.224.108:/home/jcs78/git/news-box-app/deploySystem/vmBuilds/buildsRabbitCommHub/buildLimbo/rabbitCommHubZip_Deploy.tar.gz ./remoteZipStorage

rm -r rabbitCommHub/

tar -xvzf ./remoteZipStorage/rabbitCommHubZip_Deploy.tar.gz -C ./

