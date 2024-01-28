/// @example eglplus/basic_info.cpp
///
/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
/// https://www.boost.org/LICENSE_1_0.txt
///

#include <eagine/eglplus/egl.hpp>
#include <eagine/eglplus/egl_api.hpp>
#include <iostream>

auto main() -> int {
    using namespace eagine;
    using namespace eagine::eglplus;

    const egl_api egl;

    if(const ok display{egl.get_display()}) {
        if(egl.initialize(display)) {
            const auto do_cleanup = egl.terminate.raii(display);

            if(const ok dev_count{egl.query_devices.count()}) {
                std::cout << "Devices: " << dev_count << std::endl;
            }

            if(const ok vendor{egl.query_string(display, egl.vendor)}) {
                std::cout << "Vendor:  " << extract(vendor) << std::endl;
            }

            if(const ok version{egl.query_string(display, egl.version)}) {
                std::cout << "Version: " << extract(version) << std::endl;
            }

        } else {
            std::cout << "failed to initialize EGL" << std::endl;
        }
    } else {
        std::cout << "failed to get default display" << std::endl;
    }
    return 0;
}
