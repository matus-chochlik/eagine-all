# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
add_executable(eagine-shapes-test test_shapes.cpp)
target_link_libraries(eagine-shapes-test PUBLIC EAGine::Shapes)
add_executable(eagine-sslplus-test test_sslplus.cpp)
target_link_libraries(eagine-sslplus-test PUBLIC EAGine::SSLplus)
add_executable(eagine-msgbus-test test_msgbus.cpp)
target_link_libraries(eagine-msgbus-test PUBLIC EAGine::MsgBus)
add_executable(eagine-app-test test_app.cpp)
target_link_libraries(eagine-app-test PUBLIC EAGine::App)

