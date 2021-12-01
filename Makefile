# Mute all `make` specific output. Comment this out to get some debug information.
.SILENT:


help:
	@echo "Usage:"
	@echo "     make [command]"
	@echo
	@echo "Available commands:"
	@grep '^[^#[:space:]].*:' Makefile | grep -v '^default' | grep -v '^\.' | grep -v '=' | grep -v '^_' | sed 's/://' | xargs -n 1 echo ' -'

########################################################################################################################


code-analyse:
	./vendor/bin/phpstan analyse

cs-fix:
	./vendor/bin/ecs --fix


cs-check:
	./vendor/bin/ecs

pre-commit:
	$(MAKE) cs-check
	$(MAKE) code-analyse
	$(MAKE) test

test:
	./vendor/bin/phpunit


test-coverage:
	/usr/bin/phpdbg -qrr ./vendor/bin/phpunit --coverage-html var/coverage
