#!/bin/bash
# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
arch="$(dpkg-architecture -q DEB_HOST_ARCH 2> /dev/null)"
tempdir="$(mktemp -d)"
thisdir="$(realpath $(dirname ${0}))"
function cleanup {
	rm -rf "${tempdir}"
}
trap cleanup EXIT
#
cmake --build "$(dirname ${thisdir})" --target eagine-deb-release &&\
pushd "${tempdir}" &&\
tar -zxf "${thisdir}/dpkg/release/release.tar.gz" &&\
find . -type f |\
	sed "s@^.*\$@put & /sub/eagine/apt/latest/${arch:-amd64}/@" |\
	sftp oglplus.org@oglplus.org
