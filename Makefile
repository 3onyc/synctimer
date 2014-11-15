default: js

node_modules:
	npm install

js: node_modules
	webpack -w public/assets/app/js/show.js public/assets/app/js/compiled/show.js

dev:
	fig build
	fig up

.PHONY: dev js default
