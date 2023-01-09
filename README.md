# Proyecto de agecia de transportes

## Requeriments

- docker
- vscode
- [vscode extension](https://marketplace.visualstudio.com/items?itemName=ms-azuretools.vscode-docker)

## How run this project

1. in vscode press ctrl + shift + p
2. select option: `Dev Containers: Open Folder in Container...`

## Alternative running

You can use Github Codespaces

## How to access to database

Access parameters are stored in `.devcontainer/docker-compose.yml` in db service

Actually in developement versión:
```yaml
- User: mariadb
- Password: mariadb
```

to access to database press `ctrl + shift + p` and type `Ver: Alternar Puertos`. Right click in port 8080 and press `Open in web browser` or `Open Preview`
