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
if [[ ! -z "${EAGINE_GPG_USER}" ]]
then
	pushd "dists/latest"
	gpg --local-user "${EAGINE_GPG_USER}" --armor --detach-sign --output Release.gpg Release
	gpg --local-user "${EAGINE_GPG_USER}" --clear-sign --output InRelease Release
	gpg --local-user "${EAGINE_GPG_USER}" --export --output eagine.gpg
	popd
fi
popd
# ------------------------------------------------------------------------------
