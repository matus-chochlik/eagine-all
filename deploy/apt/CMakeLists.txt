# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
# https://www.boost.org/LICENSE_1_0.txt
#
cpack_add_component(
	bootstrap
	DESCRIPTION "Bootstrap package to set-up the official EAGine apt source and key")

eagine_add_license(bootstrap)
eagine_add_debian_changelog(bootstrap)

eagine_add_package_property(
	bootstrap
	GENERATOR DEBIAN
	VARIABLE PACKAGE_DEPENDS
	VALUE "gpg")

eagine_add_package_property(
	bootstrap
	GENERATOR DEBIAN
	VARIABLE DESCRIPTION
	VALUE "Bootstrap package to set-up the official EAGine apt source and key")

eagine_add_package_property(
	bootstrap
	GENERATOR DEBIAN
	VARIABLE PACKAGE_ARCHITECTURE
	VALUE "all")

install(
	FILES "eagine.gpg"
	COMPONENT bootstrap
	PERMISSIONS OWNER_WRITE OWNER_READ GROUP_READ WORLD_READ
	DESTINATION share/keyrings)

install(
	FILES "eagine.sources"
	COMPONENT bootstrap
	PERMISSIONS OWNER_WRITE OWNER_READ GROUP_READ WORLD_READ
	DESTINATION /etc/apt/sources.list.d)

