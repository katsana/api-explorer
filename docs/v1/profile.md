---
title: User Profile

---

Developer should be able to view and update own profile using our API.

## Show Profile {#show}

### API Endpoint

    GET /profile

### Headers

| Type          | Value                             | Required
|:--------------|:----------------------------------|:---------
| Accept        | `application/vnd.KATSANA.v1+json` | Yes
| Authorization | `Bearer {{access-token}}`         | Yes

### Request

```bash
curl --request GET \
    --url https://api.katsana.com/profile \
    --header 'accept: application/vnd.KATSANA.v1+json' \
    --header 'authorization: Bearer {{access-token}}'
```

### Response

```json
{
    "id": 73,
    "email": "crynobone@gmail.com",
    "address": "Lot 2805, Jalan Damansara,\r\n60000 Kuala Lumpur.",
    "phone_home": "60123456789",
    "phone_mobile": "60123456789",
    "fullname": "Mior Muhammad Zaki",
    "meta": {
        "emergency": {
            "fullname": "",
            "phone": {
                "home": "",
                "mobile": ""
            }
        }
    },
    "avatar": null,
    "timezone": "Asia/Kuala_Lumpur",
    "created_at": "2016-09-06 21:23:53",
    "updated_at": "2016-12-18 12:10:20"
}
```

## Update Profile {#update}

### API Endpoint

    PATCH /profile

### Parameters

| Key                      | Type     | Required | Description
|:-------------------------|:---------|:---------|:---------------
| `fullname`               | `string` | No       | Full name
| `address`                | `string` | No       | Address
| `phone_home`             | `string` | No       | Home phone number
| `phone_mobile`           | `string` | No       | Mobile phone number
| `emergency_fullname`     | `string` | No       | Full name of emergency contact
| `emergency_phone_home`   | `string` | No       | Home phone number of emergency contact
| `emergency_phone_mobile` | `string` | No       | Mobile phone number of emergency contact

### Headers

| Type          | Value                             | Required
|:--------------|:----------------------------------|:---------
| Accept        | `application/vnd.KATSANA.v1+json` | Yes
| Authorization | `Bearer {{access-token}}`         | Yes

### Request

```bash
curl --request PATCH \
    --url https://api.katsana.com/profile \
    --header 'accept: application/vnd.KATSANA.v1+json' \
    --header 'authorization: Bearer {{access-token}}'
```

### Response

```json
{
    "id": 73,
    "email": "crynobone@gmail.com",
    "address": "Lot 2805, Jalan Damansara,\r\n60000 Kuala Lumpur.",
    "phone_home": "60123456789",
    "phone_mobile": "60123456789",
    "fullname": "Mior Muhammad Zaki",
    "meta": {
        "emergency": {
            "fullname": "",
            "phone": {
                "home": "",
                "mobile": ""
            }
        }
    },
    "avatar": null,
    "timezone": "Asia/Kuala_Lumpur",
    "created_at": "2016-09-06 21:23:53",
    "updated_at": "2016-12-18 12:10:20"
}
```

## Upload Avatar {#avatar}

### API Endpoint

    POST /profile/avatar

### Parameters

| Key      | Type     | Required | Description
|:---------|:---------|:---------|:---------------
| `file`   | `file`   | Yes      | Picture file

### Headers

| Type          | Value                             | Required
|:--------------|:----------------------------------|:---------
| Accept        | `application/vnd.KATSANA.v1+json` | Yes
| Authorization | `Bearer {{access-token}}`         | Yes

### Request

```bash
curl --request POST \
    --url https://api.katsana.com/profile/avatar \
    --header 'accept: application/vnd.KATSANA.v1+json' \
    --header 'authorization: Bearer {{access-token}}'
```

### Response

```json
{
    "url": "https://carbon.katsana.com/pictures/user-5/0153cf08-31e2-11e6-99b7-08002777c33d.jpg",
    "thumb": "https://carbon.katsana.com/pictures/user-5/0153cf08-31e2-11e6-99b7-08002777c33d.thumb.jpg",
    "marker": "https://carbon.katsana.com/pictures/user-5/0153cf08-31e2-11e6-99b7-08002777c33d.marker.jpg"
}
```
