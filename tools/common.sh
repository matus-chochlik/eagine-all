#!/usr/bin/env bash
# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
repo_root="$(realpath $(dirname ${BASH_SOURCE[0]})/..)"

function ordered_submodules() {
	for mod in core ecs sslplus msgbus shapes eglplus oalplus oglplus app
	do echo ${mod}
	done
}

function ordered_repos() {
	ordered_submodules |\
	while read mod
	do echo "eagine-${mod}"
	done
}

function ordered_repo_dirs() {
	ordered_repos |\
	while read repo
	do echo "${repo_root}/submodules/${repo}"
	done
}

function ordered_all_repo_dirs() {
	ordered_repo_dirs
	echo "${repo_root}"
}

