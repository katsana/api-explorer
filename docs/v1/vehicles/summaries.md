---
title: Vehicle Summaries

---

## Today {#today}

### API Endpoint

    GET /vehicles/:id/summaries/today

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
    --url https://api.katsana.com/vehicles/:id/summaries/today \
    --header 'accept: application/vnd.KATSANA.v1+json' \
    --header 'authorization: Bearer {{access-token}}'
```

### Response

```json
{
    "date": "2017-01-10",
    "distance": 12748,
    "duration": 2302,
    "idle_duration": 113,
    "max_speed": 40,
    "trip": 2,
    "violation": 0
}
```

## Yesterday {#yesterday}

### API Endpoint

    GET /vehicles/:id/summaries/yesterday

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
    --url https://api.katsana.com/vehicles/105/summaries/yesterday \
    --header 'accept: application/vnd.KATSANA.v1+json' \
    --header 'authorization: Bearer {{access-token}}'
```

### Response

```json
{
    "date": "2017-01-09",
    "distance": 75033,
    "duration": 10430,
    "idle_duration": 234,
    "max_speed": 60,
    "trip": 5,
    "violation": 0
}
```

## Date {#date}

### API Endpoint

    GET /vehicles/:id/summaries/:year/:month/:day

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
    --url https://api.katsana.com/vehicles/:id/summaries/:year/:month/:day \
    --header 'accept: application/vnd.KATSANA.v1+json' \
    --header 'authorization: Bearer {{access-token}}'
```

### Response

```json
{
    "date": "2017-01-01",
    "distance": 29260,
    "duration": 3025,
    "idle_duration": 182,
    "max_speed": 58,
    "trip": 4,
    "violation": 0
}
```
   
## Duration {#duration}

### API Endpoint

    GET /vehicles/:id/summaries/duration?start&end

### Parameters

| Type          | Description          | Required
|:--------------|:---------------------|:---------
| `:id`         | Vehicle ID           | Yes

### Query String

| Type          | Description                    | Required
|:--------------|:-------------------------------|:---------
| `start`       | Start date (e.g: `2017-01-01`) | Yes
| `end`         | End date  (e.g: `2017-01-03`)  | Yes

### Headers

| Type          | Value                             | Required
|:--------------|:----------------------------------|:---------
| Accept        | `application/vnd.KATSANA.v1+json` | Yes
| Authorization | `Bearer {{access-token}}`         | Yes

### Request

```bash
curl --request GET \
    --url https://api.katsana.com/vehicles/:id/summaries/duration?start=:start&end=:end \
    --header 'accept: application/vnd.KATSANA.v1+json' \
    --header 'authorization: Bearer {{access-token}}'
```

### Response

```json
[
    {
        "date": "2017-01-01",
        "distance": 29260,
        "duration": 3025,
        "idle_duration": 182,
        "max_speed": 58,
        "trip": 4,
        "violation": 0
    },
    {
        "date": "2017-01-02",
        "distance": 34930,
        "duration": 5154,
        "idle_duration": 163,
        "max_speed": 56,
        "trip": 8,
        "violation": 0
    },
    {
        "date": "2017-01-03",
        "distance": 44336,
        "duration": 6988,
        "idle_duration": 0,
        "max_speed": 43,
        "trip": 9,
        "violation": 0
    }
]
```

## Month {#month}

### API Endpoint

    GET /vehicles/:id/summaries/:year/:month

### Parameters

| Type          | Description          | Required
|:--------------|:---------------------|:---------
| `:id`         | Vehicle ID           | Yes
| `:year`       | Year                 | Yes
| `:month`      | Month                | Yes

### Headers

| Type          | Value                             | Required
|:--------------|:----------------------------------|:---------
| Accept        | `application/vnd.KATSANA.v1+json` | Yes
| Authorization | `Bearer {{access-token}}`         | Yes

### Request

```bash
curl --request GET \
    --url https://api.katsana.com/vehicles/:id/summaries/:year/:month \
    --header 'accept: application/vnd.KATSANA.v1+json' \
    --header 'authorization: Bearer {{access-token}}'
```

### Response

```json
[
    {
        "date": "2017-01-01",
        "distance": 29260,
        "duration": 3025,
        "idle_duration": 182,
        "max_speed": 58,
        "trip": 4,
        "violation": 0
    },
    {
        "date": "2017-01-02",
        "distance": 34930,
        "duration": 5154,
        "idle_duration": 163,
        "max_speed": 56,
        "trip": 8,
        "violation": 0
    },
    {
        "date": "2017-01-03",
        "distance": 44336,
        "duration": 6988,
        "idle_duration": 0,
        "max_speed": 43,
        "trip": 9,
        "violation": 0
    },
    
    // ....
]
```
