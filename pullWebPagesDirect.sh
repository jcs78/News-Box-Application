#!/bin/bash

scp jcs78@127.0.0.1:/home/jcs78/git/news-box-app/deploySystem/vmBuilds/buildsWebPages/buildLimbo/webPageZip_Deploy.tar.gz ~/git/news-box-app/localZipStorage

tar -xvzf ~/git/news-box-app/webPageZip_Deploy.tar.gz -C ~/git/news-box-app

