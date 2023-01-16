datenow="$(date +'%Y-%m-%d_%H-%M')"
mysqldump -u agencia -pagencia -h db --all-databases > $datenow.dump.sql