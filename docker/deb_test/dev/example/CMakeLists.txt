# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
add_executable(eagine-ecs-test test_ecs.cpp)
target_link_libraries(eagine-ecs-test PUBLIC EAGine::ECS)
add_executable(eagine-sslplus-test test_sslplus.cpp)
target_link_libraries(eagine-sslplus-test PUBLIC EAGine::SSLplus)
add_executable(eagine-msgbus-test test_msgbus.cpp)
target_link_libraries(eagine-msgbus-test PUBLIC EAGine::MsgBus)
add_executable(eagine-shapes-test test_shapes.cpp)
target_link_libraries(eagine-shapes-test PUBLIC EAGine::Shapes)
add_executable(eagine-eglplus-test test_eglplus.cpp)
target_link_libraries(eagine-eglplus-test PUBLIC EAGine::EGLplus)
add_executable(eagine-oglplus-test test_oglplus.cpp)
target_link_libraries(eagine-oglplus-test PUBLIC EAGine::OGLplus)
add_executable(eagine-oalplus-test test_oalplus.cpp)
target_link_libraries(eagine-oalplus-test PUBLIC EAGine::OALplus)
add_executable(eagine-app-test test_app.cpp)
target_link_libraries(eagine-app-test PUBLIC EAGine::App)

