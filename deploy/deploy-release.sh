#!/bin/bash -e
# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
# https://www.boost.org/LICENSE_1_0.txt
#
# ------------------------------------------------------------------------------
"$(dirname ${0})/build-release.sh"
"$(dirname ${0})/sign-release.sh"
"$(dirname ${0})/push-release.sh"
# ------------------------------------------------------------------------------
