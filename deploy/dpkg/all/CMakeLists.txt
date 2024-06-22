# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
# https://www.boost.org/LICENSE_1_0.txt
#
cpack_add_component(
	all
	DESCRIPTION "Metapackage installing all EAGine packages.")

eagine_add_license(all)
eagine_add_debian_changelog(all)

eagine_add_package_property(
	all
	GENERATOR DEBIAN
	VARIABLE PACKAGE_DEPENDS
	VALUE "eagine-all-assets(>= ${EAGINE_VERSION}),eagine-all-tools (>= ${EAGINE_VERSION}),eagine-all-dev(>= ${EAGINE_VERSION})")

eagine_add_package_property(
	all
	GENERATOR DEBIAN
	VARIABLE DESCRIPTION
	VALUE "Metapackage installing all EAGine packages.")

