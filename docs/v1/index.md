---
title: Getting Started

---

KATSANA API allows everyone to build apps on the KATSANA Platform. Our API is organized around REST. JSON will be returned in all responses from the API, including errors.

Let’s walk through core API concepts as we tackle some everyday use cases.

## Data Format {#data-format}


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

### Date 

Date data will be returned using `YYYY-MM-DD` format (e.g: `2016-12-31`) using `UTC` timezone.

### Datetime

Datetime data will be returned using `YYYY-MM-DD H:i:s` format (e.g: `2016-12-31 14:31:21`) using `UTC` format.

### Distance

Distance data will be returned in `metre`.

### Duration

Duration data will be return in `seconds`.

### Ignition

Ignition value is either `true` when power is on, `false` when power is off and `null` if beacon is configured without ignition status.

### Odometer

Odometer value will be returned in `kilometre`.

### Score

Score value will be returned in `percentage`, between `0-100`. The higher the value, the better the score.

### Speed

All speed data will be returned in `knot`.

### Voltage

Voltage data will be returned using `milivolt`.


## API Information {#api-information}

To get started, you can first try out our default welcome API, which would return the current Platform version and list of supported API versions.

### Request

```bash
curl --request GET \
    --url https://api.katsana.com \
    --header 'accept: application/vnd.KATSANA.v1+json'
```

### Headers

| Type          | Value                            | Required
|:--------------|:---------------------------------|:---------
| Accept        | application/vnd.KATSANA.v1+json  | Yes
| Authorization | Bearer `{{access-token}}`        | No

### Response

```json
{
    "platform": "v4.3.9",
    "api": [
        "v1"
    ]
}
```
