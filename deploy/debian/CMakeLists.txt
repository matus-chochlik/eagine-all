# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
execute_process(
	COMMAND ${DPKG_ARCHITECTURE_COMMAND} --query DEB_BUILD_ARCH
	OUTPUT_VARIABLE PKG_ARCH
	OUTPUT_STRIP_TRAILING_WHITESPACE
)
execute_process(
	COMMAND ${DPKG_ARCHITECTURE_COMMAND} --query DEB_BUILD_MULTIARCH
	OUTPUT_VARIABLE PKG_MULTIARCH
	OUTPUT_STRIP_TRAILING_WHITESPACE
)
set(PKG_VERSION ${EAGINE_VERSION})
set(PKG_NAME "eagine-all-dev_${EAGINE_VERSION}-1_${PKG_ARCH}")
set(PKG_DIR "${CMAKE_CURRENT_BINARY_DIR}/${PKG_NAME}")

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
	eagine-all-deb
	DEPENDS ${PKG_NAME}.deb
		eagine-core-deb
		eagine-ecs-deb
		eagine-shapes-deb
		eagine-sslplus-deb
		eagine-msgbus-deb
		eagine-eglplus-deb
		eagine-oglplus-deb
		eagine-oalplus-deb
		eagine-app-deb
)
install(
	FILES "${CMAKE_CURRENT_BINARY_DIR}/${PKG_NAME}.deb"
	DESTINATION opt/eagine/debian/
	COMPONENT deb-packages
	EXCLUDE_FROM_ALL
	OPTIONAL
)

add_custom_command(
	OUTPUT "${CMAKE_INSTALL_PREFIX}/opt/eagine/debian/${PKG_NAME}.deb"
	COMMAND ${CMAKE_COMMAND}
	ARGS -DCOMPONENT=deb-packages -P cmake_install.cmake
	WORKING_DIRECTORY "${CMAKE_CURRENT_BINARY_DIR}"
	MAIN_DEPENDENCY "${CMAKE_CURRENT_BINARY_DIR}/${PKG_NAME}.deb"
	DEPENDS "${CMAKE_CURRENT_BINARY_DIR}/${PKG_NAME}.deb"
)

add_custom_command(
	OUTPUT "${CMAKE_INSTALL_PREFIX}/opt/eagine/debian/${PKG_NAME}.deb"
	COMMAND ${CMAKE_COMMAND}
	ARGS -DCOMPONENT=deb-packages -P cmake_install.cmake
	WORKING_DIRECTORY "${CMAKE_CURRENT_BINARY_DIR}"
	MAIN_DEPENDENCY "${CMAKE_CURRENT_BINARY_DIR}/${PKG_NAME}.deb"
	DEPENDS "${CMAKE_CURRENT_BINARY_DIR}/${PKG_NAME}.deb"
)

add_custom_target(
	install-eagine-all-deb
	DEPENDS "${CMAKE_INSTALL_PREFIX}/opt/eagine/debian/${PKG_NAME}.deb"
)

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
		install-eagine-all-deb
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

