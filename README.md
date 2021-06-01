# Dependencies

- Docker

# Installation

Download the project and execute `make build` to download Docker container and install all its composer dependencies.

# Basic usage

Once project is downloaded, we will execute:
- `make start`, to start the container.
- `make stop`, to stop the container.
- `make shell`, to use the interactive shell.

For more actions, execute `make` without arguments.

# Mars Rover Mission

You can interact with the following endpoints (can be executed in /etc/endpoints/mars_rover_mission_api.http):

|     Endpoint    | Verb |                                                                             Description                                                                            |
|:---------------|:----:|:------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| /map/generate   | POST | Generates a map, overwriting the previous one.                                                                                                                    |
| /map            | GET  | Gets the actual map.                                                                                                                                               |
| /rover/position | POST | Sets the rover to a position in the map.                                                                                                                           |
| /rover/move     | PUT  | Moves the rover in the map. Uses the Following instructions (**F**: Moves forward, **R**: Changes facing direction to its right, **L**: Changes facing direction to its left). |

### TODO
 - Exception mapping
