# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
add_executable(eagine-app-test app_test.cpp)
target_link_libraries(eagine-app-test PUBLIC EAGine::App)

