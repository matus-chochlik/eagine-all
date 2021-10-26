# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
cmake_minimum_required(VERSION 3.16)
project(eagine_app_deb_test CXX)

set (CMAKE_CXX_STANDARD 20)
set (CMAKE_CXX_STANDARD_REQUIRED ON)
set (CMAKE_CXX_EXTENSIONS OFF)

find_package(EAGine REQUIRED COMPONENTS
	ECS
	SSLplus
	MsgBus
	Shapes
	EGLplus
	OGLplus
	OALplus
	App
)

if(EAGineApp_FOUND)
	if(TARGET EAGine::App)
		message("EAGine App found")
		add_subdirectory(example)
	else()
		message(FATAL_ERROR "EAGine App target not found")
	endif()
else()
	message(FATAL_ERROR "EAGine App package not found")
endif()

