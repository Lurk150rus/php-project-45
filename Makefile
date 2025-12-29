# Makefile
install: 
	composer install

brain-games:
	./bin/brain-games

validate:
	composer validate

autoload:
	composer dump-autoload

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin
