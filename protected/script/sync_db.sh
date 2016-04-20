#!/bin/bash

mysqldump -udota -p123456 -h123.56.176.188 dota  > /tmp/dota.sql
mysql -h127.0.0.1 -P23306 -udota -pmigu dota < /tmp/dota.sql
