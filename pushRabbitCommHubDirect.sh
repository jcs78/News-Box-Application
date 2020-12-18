#!/bin/bash

tar -czvf rabbitCommHubZip_Deploy.tar.gz rabbitCommHub

mv ./rabbitCommHubZip_Deploy.tar.gz ./localZipStorage

scp ./localZipStorage/rabbitCommHubZip_Deploy.tar.gz jcs78@10.192.224.108:/home/jcs78/git/news-box-app/deploySystem/vmBuilds/buildsRabbitCommHub/buildLimbo

