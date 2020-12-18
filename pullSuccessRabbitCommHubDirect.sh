#!/bin/bash

scp jcs78@127.0.0.1:/home/jcs78/git/news-box-app/deploySystem/vmBuilds/buildsRabbitCommHub/buildSuccess/rabbitCommHubZip_Deploy.tar.gz ~/git/news-box-app/remoteZipStorage

rm -r rabbitCommHub/

tar -xvzf ~/git/news-box-app/remoteZipStorage/rabbitCommHubZip_Deploy.tar.gz -C ~/git/news-box-app

