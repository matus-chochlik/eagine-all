#!/bin/bash
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
# https://www.boost.org/LICENSE_1_0.txt
#
cd "$(dirname ${0})"
ls *.deb |\
sed 's/eagine-\(\w\+\)-dev_[0-9]\+\.[0-9]\+\.[0-9]\+-[0-9]\+_\w\+\.deb/& eagine-\1-dev.deb/' |\
while read src dst
do mv "${src}" "${dst}"
done
