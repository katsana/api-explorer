---
title: Authentication

---

KATSANA API uses OAuth2 server implementation for API integration which is built on top of [Laravel Passport](https://laravel.com/docs/5.3/passport).

## Creating a Client {#creating-client}

Coming soon.

## Requesting Tokens {#requesting-tokens}

Coming soon.

## Personal Access Token {#personal-access-token}

Each API developer should be able to generate Personal Access Token. From the top right menu on the Platform, click on **[Account Settings](https://my.katsana.com/account/edit)**.

![]({asset-url}/images/v1/account-settings.png)

Next go to **[API Token](https://my.katsana.com/account/edit#api)** sub-menu and click on **Create New Token**.

![]({asset-url}/images/v1/api-token.png)

Type-in a name for the personal access token, add click **Create**.

![]({asset-url}/images/v1/create-access-token.png)

Once generated, you're see a modal containing your access token.

![]({asset-url}/images/v1/personal-access-token.png)

<div class="callout callout-warning" role="alert">
    <h4>WARNING</h4>
    <p>Please copy this information to your application and on no condition share this key to anyone else.</p>
</div>
