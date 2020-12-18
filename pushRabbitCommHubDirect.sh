#!/bin/bash

tar -czvf rabbitCommHubZip_Deploy.tar.gz rabbitCommHub

mv ~/git/news-box-app/rabbitCommHubZip_Deploy.tar.gz ~/git/news-box-app/localZipStorage

scp ~/git/news-box-app/localZipStorage/rabbitCommHubZip_Deploy.tar.gz jcs78@127.0.0.1:/home/jcs78/git/news-box-app/deploySystem/vmBuilds/buildsRabbitCommHub/buildLimbo

