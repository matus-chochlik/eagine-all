# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
# https://www.boost.org/LICENSE_1_0.txt
cpack_add_component(
	all-dev
	DESCRIPTION "High-level C++ utilities for implementing multimedia applications.")

eagine_add_module(
	eagine.all
	COMPONENT all-dev
	IMPORTS
		std
		eagine.core.resource
		eagine.core
		eagine.ecs
		eagine.shapes
		eagine.sslplus
		eagine.msgbus
		eagine.eglplus
		eagine.oalplus
		eagine.oglplus
		eagine.guiplus
		eagine.app
		eagine.app.resource_provider)

eagine_add_license(all-dev)
eagine_add_debian_changelog(all-dev)

eagine_add_package_property(
	all-dev
	GENERATOR DEBIAN
	VARIABLE PACKAGE_DEPENDS
	VALUE "eagine-core-dev (>= ${EAGINE_VERSION}),eagine-ecs-dev (>= ${EAGINE_VERSION}),eagine-sslplus-dev (>= ${EAGINE_VERSION}),eagine-msgbus-dev (>= ${EAGINE_VERSION}),eagine-shapes-dev (>= ${EAGINE_VERSION}),eagine-guiplus-dev (>= ${EAGINE_VERSION}),eagine-eglplus-dev (>= ${EAGINE_VERSION}),eagine-oglplus-dev (>= ${EAGINE_VERSION}),eagine-oalplus-dev (>= ${EAGINE_VERSION}),eagine-app-dev (>= ${EAGINE_VERSION})")

eagine_add_package_property(
	all-dev
	GENERATOR DEBIAN
	VARIABLE DESCRIPTION
	VALUE "High-level C++ utilities for implementing multimedia applications.")

