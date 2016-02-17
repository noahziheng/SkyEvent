echo "Clear Folder"
rm -rf ../../skyevent-dist/*
echo "Build Product"
webpack --progress --hide-modules --config build/webpack.prod.conf.js
echo "Push to Repo"
cd ../../skyevent-dist/
git add .
git commit -am "buildbot update"
git push