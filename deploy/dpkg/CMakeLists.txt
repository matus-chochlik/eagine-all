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

set(PKG_VERSION ${EAGINE_VERSION}-${EAGINE_GIT_COMMITS_SINCE_VERSION})
set(SRC_DIR "${CMAKE_CURRENT_SOURCE_DIR}/../..")
set(BIN_DIR "${CMAKE_CURRENT_BINARY_DIR}/../..")

add_custom_target(eagine-all-deb)

add_subdirectory(dev)
add_subdirectory(tools)

if(NOT TARGET eagine-deb)
	add_custom_target(eagine-deb)
endif()

add_dependencies(eagine-deb eagine-all-deb)
