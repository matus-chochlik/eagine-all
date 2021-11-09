/// @example eagine/msgbus/log_certs.cpp
///
/// Copyright Matus Chochlik.
/// Distributed under the Boost Software License, Version 1.0.
/// See accompanying file LICENSE_1_0.txt or copy at
///  http://www.boost.org/LICENSE_1_0.txt
///
#include <eagine/logging/logger.hpp>
#include <eagine/main.hpp>
#include <eagine/msgbus/resources.hpp>

namespace eagine {
//------------------------------------------------------------------------------
auto main(main_ctx& ctx) -> int {
    ctx.log()
      .info("embedded router certificate")
      .arg(EAGINE_ID(arg), msgbus::router_certificate_pem(ctx));
    ctx.log()
      .info("embedded bridge certificate")
      .arg(EAGINE_ID(arg), msgbus::bridge_certificate_pem(ctx));
    ctx.log()
      .info("embedded endpoint certificate")
      .arg(EAGINE_ID(arg), msgbus::endpoint_certificate_pem(ctx));
    return 0;
}
//------------------------------------------------------------------------------
} // namespace eagine
