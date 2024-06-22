#!/bin/bash -e
# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
# https://www.boost.org/LICENSE_1_0.txt
#
arch="$(dpkg-architecture -q DEB_HOST_ARCH 2> /dev/null)"
thisdir="$(realpath $(dirname ${0}))"
#
pushd "${thisdir}
cmake --build . --target all
cpack -G DEB

exit
find . -type f |\
	sed "s@^.*\$@put & /sub/eagine/apt/latest/${arch:-amd64}/@" |\
	sftp oglplus.org@oglplus.org
popd
