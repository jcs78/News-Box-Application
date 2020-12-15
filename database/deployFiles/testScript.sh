#!/bin/bash

echo Version Number: 

read versionNum

echo Version Number is $versionNum

file="testPackage${versionNum}.gar.gz"

tar -czvf $file testDir

scp $file nolandep@10.192.226.100:/home/nolandep/scpTests

