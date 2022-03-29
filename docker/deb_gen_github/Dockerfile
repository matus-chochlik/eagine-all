# Distributed under the Boost Software License, Version 1.0.
# See accompanying file LICENSE_1_0.txt or copy at
#  http://www.boost.org/LICENSE_1_0.txt
#
FROM ubuntu
LABEL maintainer="chochlik@gmail.com"

ARG DEBIAN_FRONTEND=noninteractive
RUN apt-get --yes update
RUN apt-get --yes upgrade
RUN apt-get --yes install pkgconf cmake make g++
RUN apt-get --yes install \
	dpkg-dev \
	libsystemd-dev \
	zlib1g-dev \
	libssl-dev \
	libegl-dev \
	libglew-dev \
	libglfw3-dev \
	libopenal-dev \
	libalut-dev \
	libpng-dev \
	python3 \
	git

ARG EAGINE_BUILDID=1
ARG EAGINE_CPUCOUNT=1
ARG EAGINE_BRANCH=main
ARG EAGINE_BUILD_TYPE=Release
RUN git clone \
	--branch "$EAGINE_BRANCH" \
	https://github.com/matus-chochlik/eagine-all.git \
	/tmp/eagine-$EAGINE_BUILDID &&\
	mkdir -p /tmp/eagine-$EAGINE_BUILDID/_build &&\
	cmake \
		"-DCMAKE_INSTALL_PREFIX=/tmp/eagine" \
		"-DCMAKE_BUILD_TYPE=$EAGINE_BUILD_TYPE" \
		-S /tmp/eagine-$EAGINE_BUILDID \
		-B /tmp/eagine-$EAGINE_BUILDID/_build  &&\
	cmake \
		--build /tmp/eagine-$EAGINE_BUILDID/_build \
		--target install-eagine-apt-release \
		--parallel $EAGINE_CPUCOUNT
