---
title: Vehicles

---

Get vehicles information available for the user.

## List Vehicles {#list-vehicles}

List vehicle owned or viewable by the authenticated user.

### API Endpoint

    GET /vehicles

### Headers

| Type          | Value                             | Required
|:--------------|:----------------------------------|:---------
| Accept        | `application/vnd.KATSANA.v1+json` | Yes
| Authorization | `Bearer {{access-token}}`         | Yes

### Request

```bash
curl --request GET \
    --url https://api.katsana.com/vehicles \
    --header 'accept: application/vnd.KATSANA.v1+json' \
    --header 'authorization: Bearer {{access-token}}'
```

### Response

```json
{
    "devices": [
        {
            "id": 105,
            "user_id": 1,
            "imei": "356173063386671",
            "description": "Peugeot 308",
            "vehicle_number": "WXG 3365",
            "current": {
                "latitude": 3.0088311,
                "longitude": 101.5975165,
                "speed": 0,
                "state": "idle",
                "ignition": false,
                "voltage": 12485,
                "gsm": 3,
                "tracked_at": "2017-01-09 13:31:51"
            },
            "avatar": "https://s3-ap-southeast-1.amazonaws.com/carbon.katsana/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.thumb.png",
            "marker": "https://s3-ap-southeast-1.amazonaws.com/carbon.katsana/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.marker.png",
            "today_max_speed": 60.47518,
            "odometer": 124277,
            "ends_at": "2020-08-30 16:00:00",
            "timezone": "Asia/Kuala_Lumpur"
        }
    ]
}
```
 
## Single Vehicle {#single-vehicle}

Show single vehicle owned or viewable by the authenticated user.
Show single vehicle owned or viewable by the authenticated user.

### API Endpoint

    GET /vehicles/:id

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
    --url https://api.katsana.com/vehicles/105 \
    --header 'accept: application/vnd.KATSANA.v1+json' \
    --header 'authorization: Bearer {{access-token}}'
```

### Response

```json
{
    "device": {
        "id": 105,
        "user_id": 1,
        "imei": "356173063386671",
        "description": "Peugeot 308 Jejaka",
        "vehicle_number": "WXG 3365",
        "current": {
            "latitude": 3.0088311,
            "longitude": 101.5975165,
            "speed": 0,
            "state": "idle",
            "ignition": false,
            "voltage": 12485,
            "gsm": 3,
            "tracked_at": "2017-01-09 13:31:51"
        },
        "avatar": "https://s3-ap-southeast-1.amazonaws.com/carbon.katsana/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.thumb.png",
        "marker": "https://s3-ap-southeast-1.amazonaws.com/carbon.katsana/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.marker.png",
        "today_max_speed": 60.47518,
        "odometer": 124277,
        "ends_at": "2020-08-30 16:00:00",
        "timezone": "Asia/Kuala_Lumpur"
    }
}
```

## Vehicles Location {#vehicle-location}

Get current location for a vehicle.

## API Endpoint

    GET /vehicles/:id/location

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
    --url https://api.katsana.com/vehicles/105/location \
    --header 'accept: application/vnd.KATSANA.v1+json' \
    --header 'authorization: Bearer {{access-token}}'
```

### Response

```json
{
    "id": 105,
    "latitude": 3.0088311,
    "longitude": 101.5975165,
    "speed": 0,
    "state": "idle",
    "ignition": false,
    "voltage": 12485,
    "gsm": 3,
    "tracked_at": "2017-01-09 13:31:51"
}
```
