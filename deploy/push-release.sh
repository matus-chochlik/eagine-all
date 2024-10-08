#!/bin/bash -e
# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
# https://www.boost.org/LICENSE_1_0.txt
#
# ------------------------------------------------------------------------------
bindir="@PROJECT_BINARY_DIR@"
pkgdir="$(realpath ${bindir}/release)"
# ------------------------------------------------------------------------------
pushd "${pkgdir}"
(
find . -type d | sed -n 's@^\./\(.*\)$@mkdir /sub/eagine/apt/\1@p'
find . -type f | sed -n 's@^\./\(\([^/]\+/\)*\)[^/]\+$@put & /sub/eagine/apt/\1@p'
) | sftp oglplus.org@oglplus.org
popd
# ------------------------------------------------------------------------------
