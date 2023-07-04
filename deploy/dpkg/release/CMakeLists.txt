# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
# ------------------------------------------------------------------------------
configure_file(build-Release.sh.in build-Release.sh @ONLY)
# ------------------------------------------------------------------------------
add_custom_command(
	OUTPUT release.tar.gz
	BYPRODUCTS Packages.gz Release Release.gpg InRelease EAGine.gpg
	COMMAND ${BASH_COMMAND}
	ARGS build-Release.sh
	WORKING_DIRECTORY "${CMAKE_CURRENT_BINARY_DIR}"
	DEPENDS eagine-deb
	COMMENT "Building dpkg/apt package release"
)

add_custom_target(eagine-deb-release DEPENDS release.tar.gz)
# ------------------------------------------------------------------------------
