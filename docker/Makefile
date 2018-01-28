NAME := heroku-laravel
VERSION := 2.0
VERSION_TAG := $(NAME):$(VERSION)
LATEST_TAG := $(NAME):latest

.PHONY: build
build:
	docker build -t $(VERSION_TAG) .
	docker build -t $(LATEST_TAG) .
