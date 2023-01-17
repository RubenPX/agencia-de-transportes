if [ -z "$1" ]
  then
    echo "No argument supplied"
    echo "Syntax: ImprtDB.sh sql-file"
fi

mysql -u agencia -pagencia -h db -w < $1