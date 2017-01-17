---
title: API Information

---

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
