# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
# https://www.boost.org/LICENSE_1_0.txt
#
add_subdirectory(apt)

find_program(DPKG_SCANPACKAGES_COMMAND dpkg-scanpackages)
if(DPKG_SCANPACKAGES_COMMAND)
	configure_file(deploy-release.sh deploy-release.sh @ONLY)
	add_subdirectory(dpkg)
endif()
