# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
add_custom_command(
	OUTPUT Packages
	COMMAND "${DPKG_SCANPACKAGES_COMMAND}" "${CMAKE_INSTALL_PREFIX}/opt/eagine/debian" > Packages
	WORKING_DIRECTORY "${CMAKE_CURRENT_BINARY_DIR}"
	DEPENDS
		install-eagine-core-deb
		install-eagine-ecs-deb
		install-eagine-shapes-deb
		install-eagine-sslplus-deb
		install-eagine-msgbus-deb
		install-eagine-eglplus-deb
		install-eagine-oglplus-deb
		install-eagine-oalplus-deb
		install-eagine-app-deb
	COMMENT "Scanning Debian packages"
)

add_custom_command(
	OUTPUT Packages.gz
	COMMAND ${GZIP_COMMAND} -9 Packages
	WORKING_DIRECTORY "${CMAKE_CURRENT_BINARY_DIR}"
	DEPENDS Packages
	COMMENT "Compressing Debian package list"
)

install(
	FILES "${CMAKE_CURRENT_BINARY_DIR}/Packages.gz"
	DESTINATION opt/eagine/debian/
	COMPONENT deb-packages
	EXCLUDE_FROM_ALL
	OPTIONAL
)

add_custom_command(
	OUTPUT "${CMAKE_INSTALL_PREFIX}/opt/eagine/debian/Packages.gz"
	COMMAND ${CMAKE_COMMAND}
	ARGS -DCOMPONENT=deb-packages -P cmake_install.cmake
	WORKING_DIRECTORY "${CMAKE_CURRENT_BINARY_DIR}"
	MAIN_DEPENDENCY "${CMAKE_CURRENT_BINARY_DIR}/Packages.gz"
	DEPENDS "${CMAKE_CURRENT_BINARY_DIR}/Packages.gz"
)

add_custom_target(
	install-eagine-deb-packages
	DEPENDS "${CMAKE_INSTALL_PREFIX}/opt/eagine/debian/Packages.gz"
)

