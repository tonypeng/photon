#!/bin/sh
# echo "alias photon=\"./photon.sh\"" >> ~/.bash_profile
if [[ $1 == "build" ]];then
	php ./scripts/build.php;
fi
