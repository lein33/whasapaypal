FROM node:18-bullseye as bot
WORKDIR /app
COPY ./bot-ws-openai/package*.json ./
RUN npm i
COPY ./bot-ws-openai .
ARG RAILWAY_STATIC_URL
ARG PUBLIC_URL
ARG PORT
CMD ["npm", "start"]