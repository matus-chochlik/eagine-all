target_link_libraries(
	eagine.core
	INTERFACE
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
		EGL
		GL
		GLEW
		glfw
		openal
		alut)