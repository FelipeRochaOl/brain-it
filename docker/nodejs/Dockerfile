FROM node:18-alpine

RUN apk update

RUN mkdir -p /home/node/app/node_modules && chown -R node:node /home/node/app

WORKDIR /home/node/app

COPY ./app/package.json /home/node/app

USER node

COPY --chown=node:node . .

RUN yarn global add typescript

RUN yarn install

EXPOSE 3000

COPY ./app /home/node/app