# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
# https://www.boost.org/LICENSE_1_0.txt
#
unset(DOC_INPUT_SOURCES)

foreach(EAGINE_MODULE
	core
	sslplus
	msgbus
	shapes
	eglplus
	oglplus
	oalplus
	ecs
	app
)
	configure_file(Doxyfile-module.in Doxyfile-${EAGINE_MODULE} @ONLY)
	file(
		GLOB_RECURSE MODULE_INPUT_SOURCES
		LIST_DIRECTORIES FALSE
		${CMAKE_CURRENT_SOURCE_DIR}/${EAGINE_MODULE}/*.hpp
		${PROJECT_SOURCE_DIR}/submodules/eagine-${EAGINE_MODULE}/include/*.hpp
		${PROJECT_SOURCE_DIR}/submodules/eagine-${EAGINE_MODULE}/example/*.hpp
		${PROJECT_SOURCE_DIR}/submodules/eagine-${EAGINE_MODULE}/example/*.cpp
	)
	list(APPEND DOC_INPUT_SOURCES ${MODULE_INPUT_SOURCES})
endforeach()
configure_file(Doxyfile-common.in Doxyfile-common @ONLY)
configure_file(Doxyfile-html.in Doxyfile-html @ONLY)
configure_file(Doxyfile-xml.in Doxyfile-xml @ONLY)

add_custom_command(
	OUTPUT "${CMAKE_CURRENT_BINARY_DIR}/xml/index.xml"
	COMMAND ${DOXYGEN_EXECUTABLE} 
	ARGS Doxyfile-xml
	WORKING_DIRECTORY "${CMAKE_CURRENT_BINARY_DIR}"
	MAIN_DEPENDENCY "${CMAKE_CURRENT_BINARY_DIR}/Doxyfile-xml"
	DEPENDS ${DOC_INPUT_SOURCES}
		"${CMAKE_CURRENT_SOURCE_DIR}/Doxyfile-xml.in"
		"${CMAKE_CURRENT_SOURCE_DIR}/Doxyfile-xml"
		"${CMAKE_CURRENT_SOURCE_DIR}/Doxyfile-common.in"
		"${CMAKE_CURRENT_SOURCE_DIR}/Doxyfile-common"
	COMMENT "Generating Doxygen XML output"
)

add_custom_command(
	OUTPUT "${CMAKE_CURRENT_BINARY_DIR}/doxygen/index.html"
	COMMAND ${DOXYGEN_EXECUTABLE} 
	ARGS Doxyfile-html
	WORKING_DIRECTORY "${CMAKE_CURRENT_BINARY_DIR}"
	MAIN_DEPENDENCY "${CMAKE_CURRENT_BINARY_DIR}/Doxyfile-html"
	DEPENDS ${DOC_INPUT_SOURCES}
		"${CMAKE_CURRENT_SOURCE_DIR}/Doxyfile-html.in"
		"${CMAKE_CURRENT_SOURCE_DIR}/Doxyfile-html"
		"${CMAKE_CURRENT_SOURCE_DIR}/Doxyfile-common.in"
		"${CMAKE_CURRENT_SOURCE_DIR}/Doxyfile-common"
		"${CMAKE_CURRENT_SOURCE_DIR}/header.html"
		"${CMAKE_CURRENT_SOURCE_DIR}/footer.html"
		"${CMAKE_CURRENT_SOURCE_DIR}/eagine.css"
	COMMENT "Generating Doxygen HTML documentation"
)

add_custom_target(
	doc-doxygen-xml
	DEPENDS "${CMAKE_CURRENT_BINARY_DIR}/xml/index.xml"
)

set_target_properties(
	doc-doxygen-xml
	PROPERTIES FOLDER "Documentation"
)

add_custom_target(
	doc-doxygen-html
	DEPENDS "${CMAKE_CURRENT_BINARY_DIR}/doxygen/index.html"
)

set_target_properties(
	doc-doxygen-html
	PROPERTIES FOLDER "Documentation"
)

install(
	DIRECTORY ${CMAKE_CURRENT_BINARY_DIR}/doxygen
	DESTINATION share/eagine/doc
	USE_SOURCE_PERMISSIONS
	COMPONENT doc-doxygen-html
	EXCLUDE_FROM_ALL
)

add_custom_command(
	OUTPUT "${CMAKE_INSTALL_PREFIX}/share/eagine/doc/doxygen/index.html"
	COMMAND ${CMAKE_COMMAND}
	ARGS -DCOMPONENT=doc-doxygen-html -P cmake_install.cmake
	WORKING_DIRECTORY "${CMAKE_CURRENT_BINARY_DIR}"
	MAIN_DEPENDENCY "${CMAKE_CURRENT_BINARY_DIR}/doxygen/index.html"
	DEPENDS "${CMAKE_CURRENT_BINARY_DIR}/doxygen/index.html"
)

add_custom_target(
	install-doc-doxygen-html
	DEPENDS "${CMAKE_INSTALL_PREFIX}/share/eagine/doc/doxygen/index.html"
)

add_dependencies(
	install-doc
	install-doc-doxygen-html
)

