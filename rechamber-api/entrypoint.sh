#!/bin/bash

set -eu

while ! curl mysql_db:3306 -vs 2>&1 | grep -q "when not allowed"; do
  sleep 1
done

$@