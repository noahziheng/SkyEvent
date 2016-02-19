FROM daocloud.io/node:4.2.6
MAINTAINER Noah Gao
EXPOSE 8888
VOLUME ["/usr/src/app"]
WORKDIR /usr/src/app
RUN npm config set registry http://registry.cnpmjs.org
RUN npm i -g nodemon
CMD npm start