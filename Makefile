default: js

node_modules:
	npm install

js: node_modules
	webpack -w public/assets/app/js/show.js public/assets/app/js/compiled/show.js

build:
	fig build

init: build
	fig run --rm app ./artisan migrate
	fig run --rm app ./artisan db:seed

dev: init
	fig up

clean:
	rm -rf node_modules
	fig kill
	fig rm --force

.PHONY: dev init build js default clean
