#!/bin/bash
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
function usage {
	echo "Usage $(basename ${0})"
	echo
	echo "-h                 : Print usage screen"
	echo "-b <branch>        : Selects the specified branch" 
	echo "-B <Debug|Release> : Selects the specified build type" 
	echo "-j <job-count>     : Use the specified number of build jobs" 
}

job_count=$(grep -c -i -e 'processor\s\+:\s*[0-9]\+' /proc/cpuinfo)
branch=main
build=Release

while getopts "hb:B:j:" arg
do
	case "${arg}" in
		b) branch="${OPTARG}";;
		B)
			if [[ "${OPTARG}" =~ ^(Debug|Release)$ ]]
			then build="${OPTARG}"
			else usage 2>&1; exit 2
			fi;;
		j)
			if [[ "${OPTARG}" =~ ^[0-9]+$ ]]
			then job_count="${OPTARG}"
			else usage 2>&1; exit 2
			fi;;
		h) usage; exit;;
		*) usage 2>&1; exit 1;;
	esac
done

mkdir -p "$(dirname ${0})/debian" &&\
docker build "$(dirname ${0})" \
	--build-arg "EAGINE_BUILDID=$(date +%s)" \
	--build-arg "EAGINE_CPUCOUNT=${job_count}" \
	--build-arg "EAGINE_BRANCH=${branch}" \
	--build-arg "EAGINE_BUILD_TYPE=${build}" \
	-t eagine_deb_build &&\
container=$(docker create eagine_deb_build) &&\
docker cp ${container}:/tmp/eagine/opt/eagine/debian "$(dirname ${0})" &&\
docker container rm ${container}
