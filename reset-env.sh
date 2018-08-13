docker-compose down --volumes
docker-compose rm

sudo find -type d -name vendor -exec rm -rf {} \;
sudo find -type d -name node_modules -exec rm -rf {} \;

sudo find docker -type d -name logs -exec rm -rf {} \;
sudo find docker -type d -name data -exec rm -rf {} \;

mkdir ./docker/composer/logs

mkdir ./docker/elasticsearch/data
mkdir ./docker/elasticsearch/logs

mkdir ./docker/mysql/data

# sudo find -type f -exec chmod 644 {} \;
# sudo find -type d -exec chmod 755 {} \;
sudo ls *.sh | xargs chmod u+x

sudo chmod 777 ./docker/* -R