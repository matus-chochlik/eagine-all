# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
add_custom_command(
	OUTPUT Packages.gz
	COMMAND ${GZIP_COMMAND} -9 Packages
	WORKING_DIRECTORY "${CMAKE_CURRENT_BINARY_DIR}"
	DEPENDS Packages
	COMMENT "Compressing Debian package list"
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

add_custom_command(
	OUTPUT Release
	COMMAND ${BASH_COMMAND}
	ARGS "${CMAKE_CURRENT_BINARY_DIR}/build-Release.sh" "${CMAKE_INSTALL_PREFIX}/opt/eagine/debian"
	WORKING_DIRECTORY "${CMAKE_CURRENT_BINARY_DIR}"
	DEPENDS install-eagine-deb-packages
	COMMENT "Generating Debian package release manifest"
)

add_custom_command(
	OUTPUT "${CMAKE_INSTALL_PREFIX}/opt/eagine/debian/Release"
	COMMAND ${CMAKE_COMMAND}
	ARGS -DCOMPONENT=deb-packages -P cmake_install.cmake
	WORKING_DIRECTORY "${CMAKE_CURRENT_BINARY_DIR}"
	MAIN_DEPENDENCY "${CMAKE_CURRENT_BINARY_DIR}/Release"
	DEPENDS "${CMAKE_CURRENT_BINARY_DIR}/Release"
)

add_custom_target(
	install-eagine-apt-release
	DEPENDS "${CMAKE_INSTALL_PREFIX}/opt/eagine/debian/Release"
)

