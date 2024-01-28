# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
# https://www.boost.org/LICENSE_1_0.txt
#
function eagine_deb_installed_size() {
	du -k -s "${1:-.}" | cut -f 1
}

