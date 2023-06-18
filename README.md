# Snap card game challenge

The project can be run in a Docker environment. The **docker-compose.yml** file is located at **/.build/docker**.

Otherwise, a Makefile is available to run things easier. Just type the command **make *command*** in your terminal.

Available commands:
| Command | Description |
|---------|-------------|
| make help | Show all commands |
| make install | Build and start containers |
| make up | Start containers |
| make test | Run tests |
| make bash | Enter into the container's CLI |
| make down | Stop containers |

When containers are up, you can access the URL http://localhost:8080 to simulate the game with different parameters. The interface is consciously rudimentary as it was not the point of the project.