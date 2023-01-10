# Proyecto de agecia de transportes

## Requeriments

- docker
- vscode
- [vscode extension](https://marketplace.visualstudio.com/items?itemName=ms-azuretools.vscode-docker)

## How run this project

1. in vscode press ctrl + shift + p
2. select option: `Dev Containers: Open Folder in Container...`

### Alternative running: You can use [Github Codespaces](https://github.com/features/codespaces) or [devcontainers using docker](https://code.visualstudio.com/docs/devcontainers/containers)

## How to access to database

Access parameters are stored in `.devcontainer/docker-compose.yml` in db service

Actually in developement versión:

> ```yaml
> - User: root
> - Password: mariadb
> ```

To access to database press `ctrl + shift + p` and type `Ver: Alternar Puertos`. Right click in port 8080 and press `Open in web browser` or `Open Preview`

## How to sync database with repository

- To dump Mysql database: `cd scripts && bash DownloadDB.sh`
- To import Mysql dump: `cd scripts && bash ImportDB.sh < example.sql`
    - Replace `example.sql` by real sql file

## How to start stop apache server

When you start a dev container server, apache automatically starts on post command

Start apache server: `apache2ctl start`
Stop apacge server: `apache2ctl stop`