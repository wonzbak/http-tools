# HTTP-tools

## Description
Some HTTP endpoints to test REST client.
Inspired by https://httpbin.org/.

## Install

```shell
git clone https://github.com/wonzbak/http-tools.git
composer install
```

## Routes
### http
#### `/`

Display request data.
```json
{

      "request": {
            "ip": "192.168.1.80",
            "headers": {
                  "host": [
                        "localhost:8091"
                  ],
                  "user-agent": [
                        "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0"
                  ],
                  "accept": [
                        "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"
                  ],
                  "accept-language": [
                        "en-US,fr-FR;q=0.7,en;q=0.3"
                  ],
                  "accept-encoding": [
                        "gzip, deflate"
                  ],
                  "dnt": [
                        "1"
                  ],
                  "sec-gpc": [
                        "1"
                  ],
                  "connection": [
                        "keep-alive"
                  ],
                  "cookie": [
                        "SID=hdt/mI/z6DGzGDsuhz3kHUu2icENQj42"
                  ],
                  "upgrade-insecure-requests": [
                        "1"
                  ],
                  "priority": [
                        "u=0, i"
                  ],
                  "x-php-ob-level": [
                        "1"
                  ]
            },
            "method": "GET",
            "scheme": "http",
            "host": "localhost:8091",
            "port": 8091,
            "path": "/",
            "query": [ ]
      }
}
```

#### `/status/:httpStatusCode`
Return a response with the given HTTP status code.
```json
{
      "status": 404,
      "text": "Not Found"
}
```

#### `/headers`
Return a response with the all request headers.
```json
{
      "host": [
            "babs.local:8091"
      ],
      "user-agent": [
            "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0"
      ],
      "accept": [
            "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"
      ],
      "accept-language": [
            "en-US,fr-FR;q=0.7,en;q=0.3"
      ],
      "accept-encoding": [
            "gzip, deflate"
      ],
      "dnt": [
            "1"
      ],
      "sec-gpc": [
            "1"
      ],
      "connection": [
            "keep-alive"
      ],
      "cookie": [
            "SID=hdt/mI/z6DGzGDsuhz3kHUu2icENQj42"
      ],
      "upgrade-insecure-requests": [
            "1"
      ],
      "priority": [
            "u=0, i"
      ],
      "x-php-ob-level": [
            "1"
      ]

}
``` 

#### `/user-agent`
Return a response with the user-agent.
```json
{
      "user-agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0"
}
```

#### `/ip`
Return a response with the IP address.
```json
{
      "ip": "192.168.0.1"
}
```

#### `/redirect?location=http://example.com/`

Return a response with the redirect status code.

### sleep

#### `/sleep/:seconds`
Return a response after the given number of seconds.
```json
{
      "sleep": "slept for 1 second(s)"
}
```

#### `/sleep-ms/:ms`
Return a response after the given number of milliseconds.
```json
{
      "sleep": "slept for 700 ms"
}
```