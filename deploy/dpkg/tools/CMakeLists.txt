# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
# https://www.boost.org/LICENSE_1_0.txt
#
cpack_add_component(
	all-tools
	DESCRIPTION "Collection of C++ comand-line tools for use with EAGine.")

eagine_add_license(all-tools)
eagine_add_debian_changelog(all-tools)

eagine_add_package_property(
	all-tools
	GENERATOR DEBIAN
	VARIABLE PACKAGE_DEPENDS
	VALUE "eagine-core-tools (>= ${EAGINE_VERSION}),eagine-oglplus-tools (>= ${EAGINE_VERSION}),eagine-app-tools (>= ${EAGINE_VERSION})")

eagine_add_package_property(
	all-tools
	GENERATOR DEBIAN
	VARIABLE DESCRIPTION
	VALUE "Collection of C++ comand-line tools for use with EAGine.")

