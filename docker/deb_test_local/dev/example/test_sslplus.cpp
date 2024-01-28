/// @example eagine/sslplus/001_list_engines.cpp
///
/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
/// https://www.boost.org/LICENSE_1_0.txt
///
#include <eagine/logging/logger.hpp>
#include <eagine/main.hpp>
#include <eagine/sslplus/openssl.hpp>

#include <eagine/sslplus/api.hpp>

#include <array>

namespace eagine {
//------------------------------------------------------------------------------
auto main(main_ctx& ctx) -> int {

    const sslplus::ssl_api ssl;

    ssl.load_builtin_engines();

    const auto func = [&ctx, &ssl](sslplus::engine eng) {
        const string_view na("N/A");
        ctx.log()
          .info("found engine")
          .arg(EAGINE_ID(id), extract_or(ssl.get_engine_id(eng), na))
          .arg(EAGINE_ID(name), extract_or(ssl.get_engine_name(eng), na));
    };

    ssl.for_each_engine(func);

    return 0;
}
//------------------------------------------------------------------------------
} // namespace eagine
