# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
find_program(BASH_COMMAND bash)
find_program(PYTHON_COMMAND python3)
find_program(DPKG_DEB_COMMAND dpkg-deb)
find_program(DPKG_ARCHITECTURE_COMMAND dpkg-architecture)
if(BASH_COMMAND AND DPKG_DEB_COMMAND AND DPKG_ARCHITECTURE_COMMAND)
	configure_file(deb_common.sh deb_common.sh COPYONLY)
	add_subdirectory(dpkg)
endif()
