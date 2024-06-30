# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
foreach(SUBMODULE
		core
		ecs
		shapes
		sslplus
		guiplus
		eglplus
		oalplus
		oglplus
		msgbus
		app)
	if(NOT TARGET eagine.${SUBMODULE})
		if(EXISTS "${CMAKE_CURRENT_SOURCE_DIR}/eagine-${SUBMODULE}/CMakeLists.txt")
			unset(SUBMODULE_INIT_ARG)
		else()
			set(SUBMODULE_INIT_ARG --init)
		endif()
		execute_process(
			COMMAND git submodule update ${SUBMODULE_INIT_ARG}
			WORKING_DIRECTORY "${CMAKE_CURRENT_SOURCE_DIR}/eagine-${SUBMODULE}"
		)
	endif()
endforeach()

foreach(SUBMODULE
		core
		ecs
		shapes
		sslplus
		guiplus
		eglplus
		oalplus
		oglplus
		msgbus
		app)
	if(NOT TARGET eagine.${SUBMODULE})
		add_subdirectory(eagine-${SUBMODULE})
	endif()
endforeach()

