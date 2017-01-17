---
title: User Profile

---

Developer should be able to view and update own profile using our API.

## Own Profile {#own}

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
