#!/bin/bash

read -p "Which is the image name? " IMAGE_NAME

docker run -ti -v ./output:/output $IMAGE_NAME php ./app/entry.php