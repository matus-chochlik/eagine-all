#!/bin/sh
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
docker build "$(dirname ${0})" \
	--build-arg EAGINE_BUILDID=$(date +%s) \
	--build-arg EAGINE_CPUCOUNT=$(grep -c -i -e 'processor\s\+:\s*[0-9]\+' /proc/cpuinfo) \
	-t eagine_dev_deb_test &&\
docker-compose up eagine_dev_deb_test 
