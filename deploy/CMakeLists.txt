# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
find_program(GZIP_COMMAND gzip)
find_program(BASH_COMMAND bash)
find_program(DPKG_DEB_COMMAND dpkg-deb)
find_program(DPKG_ARCHITECTURE_COMMAND dpkg-architecture)
find_program(DPKG_SCANPACKAGES_COMMAND dpkg-scanpackages)
if(
	GZIP_COMMAND AND
	BASH_COMMAND AND
	DPKG_DEB_COMMAND AND
	DPKG_ARCHITECTURE_COMMAND AND
	DPKG_SCANPACKAGES_COMMAND)
	configure_file(deploy-release.sh deploy-release.sh @ONLY)
	add_subdirectory(dpkg)
endif()
