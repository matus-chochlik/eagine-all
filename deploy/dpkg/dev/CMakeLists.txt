# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
set(PKG_NAME "eagine-all-dev_${EAGINE_VERSION}-${EAGINE_GIT_COMMITS_SINCE_VERSION}_${PKG_ARCH}")
set(PKG_DIR "${CMAKE_CURRENT_BINARY_DIR}/${PKG_NAME}")
set(PKG_PREFIX "${PKG_DIR}/usr")

configure_file(build-pkg.sh.in build-pkg.sh @ONLY)

add_custom_command(
	OUTPUT "${PKG_DIR}/DEBIAN/control"
	COMMAND ${BASH_COMMAND}
	ARGS "${CMAKE_CURRENT_BINARY_DIR}/build-pkg.sh"
	WORKING_DIRECTORY "${CMAKE_CURRENT_BINARY_DIR}"
	COMMENT "Copying files for ${PKG_NAME}.deb package"
)

add_custom_command(
	OUTPUT ${PKG_NAME}.deb
	COMMAND ${DPKG_DEB_COMMAND}
	ARGS --build --root-owner-group ${PKG_NAME}
	WORKING_DIRECTORY "${CMAKE_CURRENT_BINARY_DIR}"
	DEPENDS "${PKG_DIR}/DEBIAN/control"
	COMMENT "Building ${PKG_NAME}.deb package"
)

add_custom_target(
	eagine-all-dev-deb
	DEPENDS ${PKG_NAME}.deb
)

add_dependencies(eagine-all-deb eagine-all-dev-deb)

