docker-compose down --volumes
docker-compose rm

sudo find -name vendor -exec rm -rf {} \;
sudo find -name node_modules -exec rm -rf {} \;
sudo find -name bundles -exec rm -rf {} \;

sudo find docker -name logs -exec rm -rf {} \;
sudo find docker -name data -exec rm -rf {} \;

mkdir ./docker/composer/logs

mkdir ./docker/elasticsearch/data
mkdir ./docker/elasticsearch/logs

mkdir ./docker/mysql/data

# sudo find -type f -exec chmod 644 {} \;
# sudo find -type d -exec chmod 755 {} \;
sudo ls *.sh | xargs chmod u+x

sudo chmod 777 ./docker/* -R