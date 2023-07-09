#!/usr/bin/env bash
# Copyright Matus Chochlik.
# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
repo_root="$(realpath $(dirname ${BASH_SOURCE[0]})/..)"

function ordered_submodules() {
	for mod in core ecs sslplus msgbus shapes eglplus oalplus oglplus guiplus app
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

function list_remotes() {
	pushd "${repo_root}" > /dev/null 2> /dev/null
	git remote 2> /dev/null
	popd > /dev/null
}

function list_sub_remotes() {
	pushd "${repo_root}/submodules/eagine-app/submodules/eagine-core" > /dev/null 2> /dev/null
	git remote 2> /dev/null
	popd > /dev/null
}

function eagine_get_default_remote() {
	if [[ -x "$(which yq)" ]]
	then
		for yaml in ~/.config/eagine/defaults.yaml
		do
			if [[ -r "${yaml}" ]]
			then
				local choice
				if choice="$(yq -e -r ".workflow.${1}" < "${yaml}" 2> /dev/null)"
				then
					if [[ $(list_${1}s | grep -ce "${choice}") -eq 1 ]]
					then echo "${choice}"; return
					fi
				fi
			fi
		done
	fi

	if [[ -x "$(which jq)" ]]
	then
		for json in ~/.config/eagine/defaults.json
		do
			if [[ -r "${json}" ]]
			then
				if [[ -r "${json}" ]]
				then
					local choice
					if choice="$(jq -r ".workflow.${1}" < "${json}" 2> /dev/null)"
					then
						if [[ $(list_${1}s | grep -ce "${choice}") -eq 1 ]]
						then echo "${choice}"; return
						fi
					fi
				fi
			fi
		done
	fi

	if [[ $(list_${1}s | wc -l) -eq 1 ]]
	then list_${1}s; return
	fi

	for choice in github playground
	do
		if [[ $(list_${1}s | grep -ce "${choice}") -eq 1 ]]
		then echo "${choice}"; return
		fi
	done
}

function eagine_default_remote() {
	eagine_get_default_remote remote
}

function eagine_default_sub_remote() {
	eagine_get_default_remote sub_remote
}
