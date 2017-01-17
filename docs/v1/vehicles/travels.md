---
title: Vehicle Travels

---

## Today {#today}

### API Endpoint

    GET /vehicles/:id/travels/today


### Parameters

| Type          | Description          | Required
|:--------------|:---------------------|:---------
| `:id`         | Vehicle ID           | Yes

### Headers

| Type          | Value                             | Required
|:--------------|:----------------------------------|:---------
| Accept        | `application/vnd.KATSANA.v1+json` | Yes
| Authorization | `Bearer {{access-token}}`         | Yes

### Request

```bash
curl --request GET \
    --url https://api.katsana.com/vehicles/:id/travels/today \
    --header 'accept: application/vnd.KATSANA.v1+json' \
    --header 'authorization: Bearer {{access-token}}'
```

### Response

```json
{
    "trips": [
        {
            "start": {
                "id": 200811,
                "latitude": 3.0089671,
                "longitude": 101.5974525,
                "tracked_at": "2017-01-09 23:15:15"
            },
            "end": {
                "id": 200973,
                "latitude": 3.0096175,
                "longitude": 101.598688,
                "tracked_at": "2017-01-09 23:49:07"
            },
            "distance": 12230,
            "duration": 2032,
            "max_speed": 40.496773,
            "average_speed": 10.918302722759,
            "idle_duration": 113,
            "score": 100,
            "idles": [
                {
                    "id": 200812,
                    "latitude": 3.0089671,
                    "longitude": 101.5974525,
                    "tracked_at": "2017-01-09 23:15:35"
                }
            ],
            "histories": [
                {
                    "id": 200818,
                    "latitude": 3.0091215,
                    "longitude": 101.597612,
                    "speed": 3.7796988,
                    "tracked_at": "2017-01-09 23:17:28"
                },
                {
                    "id": 200819,
                    "latitude": 3.0091401,
                    "longitude": 101.5976141,
                    "speed": 3.2397418,
                    "tracked_at": "2017-01-09 23:17:29"
                },
                {
                    "id": 200820,
                    "latitude": 3.00913,
                    "longitude": 101.5976488,
                    "speed": 7.0194407,
                    "tracked_at": "2017-01-09 23:17:39"
                },
                // ...
            ],
            "violations": []
        },
        {
            "start": {
                "id": 200975,
                "latitude": 3.0096219,
                "longitude": 101.5986685,
                "tracked_at": "2017-01-09 23:53:10"
            },
            "end": {
                "id": 201002,
                "latitude": 3.0090326,
                "longitude": 101.597272,
                "tracked_at": "2017-01-09 23:57:40"
            },
            "distance": 516,
            "duration": 270,
            "max_speed": 13.498924,
            "average_speed": 7.1737142142857,
            "idle_duration": 0,
            "score": 100,
            "idles": [],
            "histories": [
                {
                    "id": 200977,
                    "latitude": 3.0096348,
                    "longitude": 101.5986675,
                    "speed": 3.7796988,
                    "tracked_at": "2017-01-09 23:53:33"
                },
                {
                    "id": 200978,
                    "latitude": 3.0096513,
                    "longitude": 101.5986498,
                    "speed": 4.859613,
                    "tracked_at": "2017-01-09 23:53:34"
                },
                {
                    "id": 200979,
                    "latitude": 3.0096923,
                    "longitude": 101.5985031,
                    "speed": 5.939527,
                    "tracked_at": "2017-01-09 23:53:39"
                },
                // ...
            ],
            "violations": []
        }
    ],
    "summary": {
        "max_speed": 40.496773,
        "distance": 12748,
        "violation": 0
    },
    "duration": {
        "from": "2017-01-09 16:00:00",
        "to": "2017-01-10 15:59:59"
    }
}
```

## Yesterday {#yesterday}

### API Endpoint

    GET /vehicles/:id/travels/yesterday

### Parameters

| Type          | Description          | Required
|:--------------|:---------------------|:---------
| `:id`         | Vehicle ID           | Yes

### Headers

| Type          | Value                             | Required
|:--------------|:----------------------------------|:---------
| Accept        | `application/vnd.KATSANA.v1+json` | Yes
| Authorization | `Bearer {{access-token}}`         | Yes

### Request

```bash
curl --request GET \
    --url https://api.katsana.com/vehicles/:id/travels/yesterday \
    --header 'accept: application/vnd.KATSANA.v1+json' \
    --header 'authorization: Bearer {{access-token}}'
```

### Response

```json
{
    "trips": [
        {
            "start": {
                "id": 200811,
                "latitude": 3.0089671,
                "longitude": 101.5974525,
                "tracked_at": "2017-01-09 23:15:15"
            },
            "end": {
                "id": 200973,
                "latitude": 3.0096175,
                "longitude": 101.598688,
                "tracked_at": "2017-01-09 23:49:07"
            },
            "distance": 12230,
            "duration": 2032,
            "max_speed": 40.496773,
            "average_speed": 10.918302722759,
            "idle_duration": 113,
            "score": 100,
            "idles": [
                {
                    "id": 200812,
                    "latitude": 3.0089671,
                    "longitude": 101.5974525,
                    "tracked_at": "2017-01-09 23:15:35"
                }
            ],
            "histories": [
                {
                    "id": 200818,
                    "latitude": 3.0091215,
                    "longitude": 101.597612,
                    "speed": 3.7796988,
                    "tracked_at": "2017-01-09 23:17:28"
                },
                {
                    "id": 200819,
                    "latitude": 3.0091401,
                    "longitude": 101.5976141,
                    "speed": 3.2397418,
                    "tracked_at": "2017-01-09 23:17:29"
                },
                {
                    "id": 200820,
                    "latitude": 3.00913,
                    "longitude": 101.5976488,
                    "speed": 7.0194407,
                    "tracked_at": "2017-01-09 23:17:39"
                },
                // ...
            ],
            "violations": []
        },
        {
            "start": {
                "id": 200975,
                "latitude": 3.0096219,
                "longitude": 101.5986685,
                "tracked_at": "2017-01-09 23:53:10"
            },
            "end": {
                "id": 201002,
                "latitude": 3.0090326,
                "longitude": 101.597272,
                "tracked_at": "2017-01-09 23:57:40"
            },
            "distance": 516,
            "duration": 270,
            "max_speed": 13.498924,
            "average_speed": 7.1737142142857,
            "idle_duration": 0,
            "score": 100,
            "idles": [],
            "histories": [
                {
                    "id": 200977,
                    "latitude": 3.0096348,
                    "longitude": 101.5986675,
                    "speed": 3.7796988,
                    "tracked_at": "2017-01-09 23:53:33"
                },
                {
                    "id": 200978,
                    "latitude": 3.0096513,
                    "longitude": 101.5986498,
                    "speed": 4.859613,
                    "tracked_at": "2017-01-09 23:53:34"
                },
                {
                    "id": 200979,
                    "latitude": 3.0096923,
                    "longitude": 101.5985031,
                    "speed": 5.939527,
                    "tracked_at": "2017-01-09 23:53:39"
                },
                // ...
            ],
            "violations": []
        }
    ],
    "summary": {
        "max_speed": 40.496773,
        "distance": 12748,
        "violation": 0
    },
    "duration": {
        "from": "2017-01-09 16:00:00",
        "to": "2017-01-10 15:59:59"
    }
}
```

## Date {#date}

### API Endpoint

    GET /vehicles/:id/travels/:year/:month/:day

### Parameters

| Type          | Description          | Required
|:--------------|:---------------------|:---------
| `:id`         | Vehicle ID           | Yes
| `:year`       | Year                 | Yes
| `:month`      | Month                | Yes
| `:day`        | Day                  | Yes

### Headers

| Type          | Value                             | Required
|:--------------|:----------------------------------|:---------
| Accept        | `application/vnd.KATSANA.v1+json` | Yes
| Authorization | `Bearer {{access-token}}`         | Yes

### Request

```bash
curl --request GET \
    --url https://api.katsana.com/vehicles/:id/travels/:year/:month/:date \
    --header 'accept: application/vnd.KATSANA.v1+json' \
    --header 'authorization: Bearer {{access-token}}'
```

### Response

```json
{
    "trips": [
        {
            "start": {
                "id": 200811,
                "latitude": 3.0089671,
                "longitude": 101.5974525,
                "tracked_at": "2017-01-09 23:15:15"
            },
            "end": {
                "id": 200973,
                "latitude": 3.0096175,
                "longitude": 101.598688,
                "tracked_at": "2017-01-09 23:49:07"
            },
            "distance": 12230,
            "duration": 2032,
            "max_speed": 40.496773,
            "average_speed": 10.918302722759,
            "idle_duration": 113,
            "score": 100,
            "idles": [
                {
                    "id": 200812,
                    "latitude": 3.0089671,
                    "longitude": 101.5974525,
                    "tracked_at": "2017-01-09 23:15:35"
                }
            ],
            "histories": [
                {
                    "id": 200818,
                    "latitude": 3.0091215,
                    "longitude": 101.597612,
                    "speed": 3.7796988,
                    "tracked_at": "2017-01-09 23:17:28"
                },
                {
                    "id": 200819,
                    "latitude": 3.0091401,
                    "longitude": 101.5976141,
                    "speed": 3.2397418,
                    "tracked_at": "2017-01-09 23:17:29"
                },
                {
                    "id": 200820,
                    "latitude": 3.00913,
                    "longitude": 101.5976488,
                    "speed": 7.0194407,
                    "tracked_at": "2017-01-09 23:17:39"
                },
                // ...
            ],
            "violations": []
        },
        {
            "start": {
                "id": 200975,
                "latitude": 3.0096219,
                "longitude": 101.5986685,
                "tracked_at": "2017-01-09 23:53:10"
            },
            "end": {
                "id": 201002,
                "latitude": 3.0090326,
                "longitude": 101.597272,
                "tracked_at": "2017-01-09 23:57:40"
            },
            "distance": 516,
            "duration": 270,
            "max_speed": 13.498924,
            "average_speed": 7.1737142142857,
            "idle_duration": 0,
            "score": 100,
            "idles": [],
            "histories": [
                {
                    "id": 200977,
                    "latitude": 3.0096348,
                    "longitude": 101.5986675,
                    "speed": 3.7796988,
                    "tracked_at": "2017-01-09 23:53:33"
                },
                {
                    "id": 200978,
                    "latitude": 3.0096513,
                    "longitude": 101.5986498,
                    "speed": 4.859613,
                    "tracked_at": "2017-01-09 23:53:34"
                },
                {
                    "id": 200979,
                    "latitude": 3.0096923,
                    "longitude": 101.5985031,
                    "speed": 5.939527,
                    "tracked_at": "2017-01-09 23:53:39"
                },
                // ...
            ],
            "violations": []
        }
    ],
    "summary": {
        "max_speed": 40.496773,
        "distance": 12748,
        "violation": 0
    },
    "duration": {
        "from": "2017-01-09 16:00:00",
        "to": "2017-01-10 15:59:59"
    }
}
```
