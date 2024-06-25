# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
# https://www.boost.org/LICENSE_1_0.txt
#
cpack_add_component(
	all-assets
	DESCRIPTION "Meta-package of collection of assets usable with EAGine.")

eagine_add_license(all-assets)
eagine_add_debian_changelog(all-assets)

eagine_add_package_property(
	all-assets
	GENERATOR DEBIAN
	VARIABLE PACKAGE_DEPENDS
	VALUE "eagine-oglplus-assets,eagine-app-assets")

eagine_add_package_property(
	all-assets
	GENERATOR DEBIAN
	VARIABLE DESCRIPTION
	VALUE "Meta-package of collection of assets usable with EAGine.")

eagine_add_package_property(
	all-assets
	GENERATOR DEBIAN
	VARIABLE PACKAGE_ARCHITECTURE
	VALUE "all")

