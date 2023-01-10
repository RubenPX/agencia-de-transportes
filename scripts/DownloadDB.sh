datenow="$(date +'%Y-%M-%d_%H-%m')"
mysqldump -u agencia -pagencia -h db --all-databases > $datenow.dump.sql