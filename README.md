# Router demo

This project is a demo of Ingenioz IT's [router](https://github.com/IngeniozIT/router).

## Setup

```bash
composer serve
```

Go to http://localhost:8080 to see the magic happen.

## Interesting files

- [index.php](index.php) the full framework code
- [config/routes.php](config/routes.php) all the routes
- [src/ReverseOutputMiddleware.php](src/ReverseOutputMiddleware.php) a middleware that inverts the output
- [src/PublicFileController.php](src/PublicFileController.php) a controller that can refuse to handle a request (and let the router find another handler)
- [config/features.php](config/features.php) a file that contains a feature flag
- [src/AwesomeFeatureIsEnabled.php](src/AwesomeFeatureIsEnabled.php) a conditional handler that checks if the "awesome feature" is enabled

## Interesting urls

- http://localhost:8080/
- http://localhost:8080/hello
- http://localhost:8080/hello/John
- http://localhost:8080/invert
- http://localhost:8080/invert/John
- http://localhost:8080/img.png
- http://localhost:8080/something-that-does-not-exist
- http://localhost:8080/awesome (if the feature flag is enabled in [config/features.php](config/features.php))