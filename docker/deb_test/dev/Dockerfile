FROM ubuntu
LABEL maintainer="chochlik@gmail.com"

ARG DEBIAN_FRONTEND=noninteractive
RUN apt-get --yes update
RUN apt-get --yes upgrade
RUN apt-get --yes install pkgconf cmake make g++

RUN mkdir -p /tmp/eagine
COPY \
	debian/eagine-core-dev.deb \
	debian/eagine-ecs-dev.deb \
	debian/eagine-shapes-dev.deb \
	debian/eagine-sslplus-dev.deb \
	debian/eagine-msgbus-dev.deb \
	debian/eagine-eglplus-dev.deb \
	debian/eagine-oglplus-dev.deb \
	debian/eagine-oalplus-dev.deb \
	debian/eagine-app-dev.deb \
	debian/eagine-all-dev.deb \
	/tmp/
COPY entrypoint /tmp/eagine
COPY CMakeLists.txt /tmp/eagine
COPY example/* /tmp/eagine/example/

WORKDIR /tmp/eagine
ENTRYPOINT /bin/sh /tmp/eagine/entrypoint
