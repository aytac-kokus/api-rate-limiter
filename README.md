# API RATE LIMITER

This plugin allows only 60 API requests per minute in WordPress from an IP.

## How does the plugin work?
The plugin hooks into `rest_api_init` hook and saves the IP counter to cache. Once the limit is reached, the requester will receive 427 HTTP code(too many requests).

## Questions
If you have any questions, please feel free to create an issue, or you can e-mail me via info@itouchcode.be.