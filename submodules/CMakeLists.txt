# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#

if(NOT TARGET EAGine::Core)
	if(EXISTS "${CMAKE_CURRENT_SOURCE_DIR}/eagine-core/CMakeLists.txt")
		unset(SUBMODULE_INIT_ARG)
	else()
		set(SUBMODULE_INIT_ARG --init)
	endif()
	execute_process(
		COMMAND git submodule update ${SUBMODULE_INIT_ARG}
		WORKING_DIRECTORY "${CMAKE_CURRENT_SOURCE_DIR}/eagine-core"
	)
	add_subdirectory(eagine-core)
endif()

if(NOT TARGET EAGine::SSLplus)
	if(EXISTS "${CMAKE_CURRENT_SOURCE_DIR}/eagine-sslplus/CMakeLists.txt")
		unset(SUBMODULE_INIT_ARG)
	else()
		set(SUBMODULE_INIT_ARG --init)
	endif()
	execute_process(
		COMMAND git submodule update ${SUBMODULE_INIT_ARG}
		WORKING_DIRECTORY "${CMAKE_CURRENT_SOURCE_DIR}/eagine-sslplus"
	)
	add_subdirectory(eagine-sslplus)
endif()

if(NOT TARGET EAGine::MsgBus)
	if(EXISTS "${CMAKE_CURRENT_SOURCE_DIR}/eagine-msgbus/CMakeLists.txt")
		unset(SUBMODULE_INIT_ARG)
	else()
		set(SUBMODULE_INIT_ARG --init)
	endif()
	execute_process(
		COMMAND git submodule update ${SUBMODULE_INIT_ARG}
		WORKING_DIRECTORY "${CMAKE_CURRENT_SOURCE_DIR}/eagine-msgbus"
	)
	add_subdirectory(eagine-msgbus)
endif()

if(NOT TARGET EAGine::Shapes)
	if(EXISTS "${CMAKE_CURRENT_SOURCE_DIR}/eagine-shapes/CMakeLists.txt")
		unset(SUBMODULE_INIT_ARG)
	else()
		set(SUBMODULE_INIT_ARG --init)
	endif()
	execute_process(
		COMMAND git submodule update ${SUBMODULE_INIT_ARG}
		WORKING_DIRECTORY "${CMAKE_CURRENT_SOURCE_DIR}/eagine-shapes"
	)
	add_subdirectory(eagine-shapes)
endif()

if(NOT TARGET EAGine::EGLplus)
	if(EXISTS "${CMAKE_CURRENT_SOURCE_DIR}/eagine-eglplus/CMakeLists.txt")
		unset(SUBMODULE_INIT_ARG)
	else()
		set(SUBMODULE_INIT_ARG --init)
	endif()
	execute_process(
		COMMAND git submodule update ${SUBMODULE_INIT_ARG}
		WORKING_DIRECTORY "${CMAKE_CURRENT_SOURCE_DIR}/eagine-eglplus"
	)
	add_subdirectory(eagine-eglplus)
endif()

if(NOT TARGET EAGine::OGLplus)
	if(EXISTS "${CMAKE_CURRENT_SOURCE_DIR}/eagine-oglplus/CMakeLists.txt")
		unset(SUBMODULE_INIT_ARG)
	else()
		set(SUBMODULE_INIT_ARG --init)
	endif()
	execute_process(
		COMMAND git submodule update ${SUBMODULE_INIT_ARG}
		WORKING_DIRECTORY "${CMAKE_CURRENT_SOURCE_DIR}/eagine-oglplus"
	)
	add_subdirectory(eagine-oglplus)
endif()

if(NOT TARGET EAGine::OALplus)
	if(EXISTS "${CMAKE_CURRENT_SOURCE_DIR}/eagine-oalplus/CMakeLists.txt")
		unset(SUBMODULE_INIT_ARG)
	else()
		set(SUBMODULE_INIT_ARG --init)
	endif()
	execute_process(
		COMMAND git submodule update ${SUBMODULE_INIT_ARG}
		WORKING_DIRECTORY "${CMAKE_CURRENT_SOURCE_DIR}/eagine-oalplus"
	)
	add_subdirectory(eagine-oalplus)
endif()

if(NOT TARGET EAGine::ECS)
	if(EXISTS "${CMAKE_CURRENT_SOURCE_DIR}/eagine-ecs/CMakeLists.txt")
		unset(SUBMODULE_INIT_ARG)
	else()
		set(SUBMODULE_INIT_ARG --init)
	endif()
	execute_process(
		COMMAND git submodule update ${SUBMODULE_INIT_ARG}
		WORKING_DIRECTORY "${CMAKE_CURRENT_SOURCE_DIR}/eagine-ecs"
	)
	add_subdirectory(eagine-ecs)
endif()

if(NOT TARGET EAGine::App)
	if(EXISTS "${CMAKE_CURRENT_SOURCE_DIR}/eagine-app/CMakeLists.txt")
		unset(SUBMODULE_INIT_ARG)
	else()
		set(SUBMODULE_INIT_ARG --init)
	endif()
	execute_process(
		COMMAND git submodule update ${SUBMODULE_INIT_ARG}
		WORKING_DIRECTORY "${CMAKE_CURRENT_SOURCE_DIR}/eagine-app"
	)
	add_subdirectory(eagine-app)
endif()
