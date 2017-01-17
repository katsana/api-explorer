---
title: Getting Started

---

KATSANA API allows everyone to build apps on the KATSANA Platform. Our API is organized around REST. JSON will be returned in all responses from the API, including errors.

Let’s walk through core API concepts as we tackle some everyday use cases.

## API Request {#api-request}

Making a request to KATSANA API is quite simple. The best way to do this is using a tool such as [Postman](http://www.getpostman.com/).

Because we aren't versioning the API in the URI we need to define an Accept header to request a specific version. The header is formatted like so.

    Accept: application/vnd.KATSANA.v1+json

In the above example we're requesting `v1` of our API. This is then followed by a plus sign and the desired format. If the format is invalid the package will attempt to use the default format you defined in your configuration.

If you don't want to use Postman you can use a command line tool such as cURL.

```bash
curl --request GET \
    --url https://api.katsana.com \
    --header 'Accept: application/vnd.KATSANA.v1+json'
```

### Authenticated Request {#authenticated-request}

To make any authenticated request, you need to include OAuth2 Access Token header which is formatted as:

    Authorization: Bearer {{access-token}}

## API Response {#api-response}

All KATSANA API endpoint would return JSON as our output format.

    Content-Type: application/json

### Rate Limiting {#rate-limiting}

Rate Limiting (throttling) allows you to limit the number of requests a client can make in a given amount of time. A limit and the expiration time is defined by a throttle.


### Data Format {#data-format}

| Type          | Format                            | Example
|:--------------|:----------------------------------|:---------
| Date          | `YYYY-MM-DD` (UTC timezone)       | `2016-12-31`
| Datetime      | `YYYY-MM-DD H:i:s` (UTC timezone) | `2016-12-31 14:31:21`
| Distance      | `metre`                           | `500`
| Duration      | `seconds`                         | `300`
| Ignition      | `true`, `false` or `null`         | `true`
| Odometer      | `kilometre`                        | `120450`
| Score         | `percentage`                      | `42`
| Speed         | `knot`                            | `60.47518`
| Voltage       | `milivolt`                        | `12436`

#### Date 

Date data will be returned using `YYYY-MM-DD` format (e.g: `2016-12-31`) using `UTC` timezone.

#### Datetime

Datetime data will be returned using `YYYY-MM-DD H:i:s` format (e.g: `2016-12-31 14:31:21`) using `UTC` format.

#### Distance

Distance data will be returned in `metre`.

#### Duration

Duration data will be return in `seconds`.

#### Ignition

Ignition value is either `true` when power is on, `false` when power is off and `null` if beacon is configured without ignition status.

#### Odometer

Odometer value will be returned in `kilometre`.

#### Score

Score value will be returned in `percentage`, between `0-100`. The higher the value, the better the score.

#### Speed

All speed data will be returned in `knot`.

#### Voltage

Voltage data will be returned using `milivolt`.


