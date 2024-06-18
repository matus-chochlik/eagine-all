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

include(eagine-ecs/config/EAGinePackageECS.cmake)
include(eagine-shapes/config/EAGinePackageShapes.cmake)
include(eagine-sslplus/config/EAGinePackageSSLplus.cmake)
include(eagine-guiplus/config/EAGinePackageGUIplus.cmake)
include(eagine-eglplus/config/EAGinePackageEGLplus.cmake)
include(eagine-oalplus/config/EAGinePackageOALplus.cmake)
include(eagine-oglplus/config/EAGinePackageOGLplus.cmake)
include(eagine-msgbus/config/EAGinePackageMsgBus.cmake)
include(eagine-app/config/EAGinePackageApp.cmake)

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

