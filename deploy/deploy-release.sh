#!/bin/bash -e
# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
# https://www.boost.org/LICENSE_1_0.txt
#
# ------------------------------------------------------------------------------
arch="$(dpkg-architecture -q DEB_HOST_ARCH 2> /dev/null)"
thisdir="$(realpath $(dirname ${0}))"
bindir="@PROJECT_BINARY_DIR@"
pkgdir="$(realpath ${bindir}/release)"
# ------------------------------------------------------------------------------
pushd "${bindir}"
cmake --build . --target all
rm -rf "${pkgdir}/pool"
rm -rf "${pkgdir}/latest"
find . -type f -executable -exec file {} \; | grep -e ELF | cut -d: -f1 | xargs strip
cpack -G DEB
pushd "${pkgdir}"
# ------------------------------------------------------------------------------
mkdir -p "dists/latest/main/binary-${arch}/"
for deb_old in *.deb
do
	deb_arch=$(dpkg-deb --field "${deb_old}" Architecture)
	deb_new="$(echo ${deb_old} | sed 's/_[0-9]\+\.[0-9]\+\.[0-9]\+//;s/-[0-9]\+_[A-Za-z0-9]\+//;s/-[0-9]\+//;')"
	mkdir -p "pool/latest/${deb_arch:=${arch}}/"
	mv "${deb_old}" "pool/latest/${deb_arch}/${deb_new}"
done
# ------------------------------------------------------------------------------
dpkg-scanpackages pool/latest > "dists/latest/main/binary-${arch}/Packages"
gzip -9 < "dists/latest/main/binary-${arch}/Packages" > "dists/latest/main/binary-${arch}/Packages.gz"
# ------------------------------------------------------------------------------
(
echo "Origin: OGLplus.org"
echo "Label: EAGine"
echo "Codename: eagine"
echo "Suite: latest"
echo "Components: main"
echo "Architectures: ${arch}"
echo "Version: @EAGINE_VERSION@-@EAGINE_GIT_COMMITS_SINCE_VERSION@"
echo "Date: $(date -R -u)"
echo "Description: EAGine release @EAGINE_VERSION@"
echo "MD5Sum:"
for f in "dists/latest/main/binary-${arch}"/*
do printf " %s %20d %s\n" "$(md5sum ${f} | cut -d' ' -f1)" "$(stat -L -c%s ${f})" "${f#dists/latest/}"
done
echo "SHA256:"
for f in "dists/latest/main/binary-${arch}"/*
do printf " %s %20d %s\n" "$(sha256sum ${f} | cut -d' ' -f1)" "$(stat -L -c%s ${f})" "${f#dists/latest/}"
done
) > "dists/latest/Release"
# ------------------------------------------------------------------------------
if [[ ! -z "${EAGINE_GPG_USER}" ]]
then
	pushd "dists/latest"
	gpg --local-user "${EAGINE_GPG_USER}" --armor --detach-sign --output Release.gpg Release
	gpg --local-user "${EAGINE_GPG_USER}" --clear-sign --output InRelease Release
	gpg --local-user "${EAGINE_GPG_USER}" --export --output eagine.gpg
	popd
fi
# ------------------------------------------------------------------------------
(
find . -type d | sed -n 's@^\./\(.*\)$@mkdir /sub/eagine/apt/\1@p'
find . -type f | sed -n 's@^\./\(\([^/]\+/\)*\)[^/]\+$@put & /sub/eagine/apt/\1@p'
) | sftp oglplus.org@oglplus.org
popd
popd
