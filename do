#!/bin/bash

TAG_RUN=$(cat tag)

IMAGE_ID=$(docker image ls | grep -i $TAG_RUN | awk '{print $3}')

docker run -ti -v ./output:/output $IMAGE_ID php /app/entry.php
