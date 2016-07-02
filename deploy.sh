#! /bin/sh
mkdir -p ../build/file
cp -rf ./* ../build/file/
rm -rf ./build/file/.git
mv ../build/file/index.php ../build/file/index-debug.php
mv ../build/file/index-release.php ../build/file/index.php
cd ../build
scp -r file root@45.32.30.78:/data/skyevent/code