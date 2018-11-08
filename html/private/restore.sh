#!/bin/bash
set -e
while read line
do
	cp -v "BONEYARD/$line" "$line"
#	rm -v "BONEYARD/$line"
done

