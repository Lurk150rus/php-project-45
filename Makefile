# Makefile
install: 
	composer install

brain-games:
	./bin/brain-games

validate:
	composer validate

autoload:
	composer dump-autoload