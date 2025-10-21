<h1 align="center">GADGETS HUB E-COMMERCE API</h1>

A Demo API for a brand that deals on all kinds of gadgets. Built with the <strong>Laravel Framework.</strong>

<h2 align="center">Table of Contents</h2>

- **[Installation and Setup](#installation-and-setup)**
- **[Authentication](#authentication)**
- **[Cart](#cart)**
- **[Gadgets](#gadgets)**
- **[Order](#order)**

## Installation and Setup

**Clone the repository**:
```bash
git clone https://github.com/nduagoziem/laravel-ecommerce-api
cd laravel-ecommerce-api
```

**Install dependencies**:
```bash
composer install
npm install
```

**Set up environment variables**:

Create a `.env` file in the root directory and add the necessary environment variables. Use `.env.example` as a guide.

**Run the application**:
  ```bash
  php artisan migrate
  php artisan serve
  npm run dev
  ```

## Authentication

<!-- REGISTER -->
<h3>Registration - Post Request</h3>

ENDPOINT

``` json
"/customer/register"
```

REQUEST

```JSON
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
}
```

RESPONSE

``` json
{
  "success": true,
  "message": "Your account was created successfully."
}
```

STATUS

``` json
201
```

<!-- LOGIN -->
<h3>Login - Post Request</h3>

ENDPOINT

``` json
"/customer/login"
```

REQUEST

```JSON
{
  "email": "john@example.com",
  "password": "password123",
}

```
RESPONSE

``` json
{
  "success": true,
  "message": "Login successful."
}
```

STATUS

``` json
200
```

<!-- CURRENTLY LOGGED IN CUSTOMER -->
<h3>Logged In Customer - Get Request</h3>

ENDPOINT

``` json
"/customer"
```

RESPONSE

```JSON
{
  "success": true,
  "message": 
  [
    "name": "John Doe",
    "email": "john@gmail.com",
  ]
}
```

STATUS

``` json
200
```

<!-- LOGOUT -->
<h3>Logout - Post Request</h3>

ENDPOINT

``` json
"/customer/logout"
```

RESPONSE

```JSON
{
  "message": "Logged out."
}
```
STATUS

``` json
200
```

## Cart

<p>You must have an account and be logged in before using the cart feature.</p>

<!-- ADD TO CART -->
<h3>Add to Cart - Post Request</h3>

ENDPOINT

``` json
"/cart/add"
```

REQUEST

```JSON
{
  "name": "Brand New PS5 Gaming Setup",
  "imagePath": "https://yourimagepath.example.com",
  "productId": 247 // Primary key of the product in the DB. Of course this is re-validated.
}
```

RESPONSE

``` json
{
  "success": true,
  "message": "Added to Cart."
}
```

STATUS

``` json
200
```
<!-- SHOW CART - All Cart Items In A Customer's Cart -->
<h3>Show Cart - Get Request</h3>

ENDPOINT

``` json
"/cart/show"
```

RESPONSE

```JSON
{
  "cart_id": 1,
  "created_at": "2025-09-24T10:27:44.000000Z",
  "id": 63,
  "image_path": "https://yourimagepath.example.com",
  "in_stock": 1,
  "name": "Digital HD Camera",
  "price": "20000.00",
  "product_id": 1,
  "quantity": 1,
  "updated_at": "2025-09-24T10:27:44.000000Z"
}
```

STATUS

``` json
200
```

<!-- UPDATE CART -->
<h3>Update Cart - Patch Request</h3>

ENDPOINT

``` json
"/cart/update"
```

REQUEST

```JSON
{
  "name": "Digital HD Camera",
  "productId": 44,
  "quantity": 102,
}
```

<!-- REMOVE FROM CART -->
<h3>Remove from cart - Post Request</h3>

ENDPOINT

``` json
"/cart/remove"
```

REQUEST

```JSON
{
  "name": "Pink Headset",
  "productId": 6,
}
```

RESPONSE

```json
{
  "success": true,
  "message": "Removed from cart."
}
```

STATUS

``` json
200
```

<!-- GET PRICE TOTAL FROM THE DB -->
<h3>Estimated Total Price - Get Request</h3>

ENDPOINT

``` json
"/cart/total"
```

RESPONSE

```JSON
{
  "message": 20000.00
}
```

STATUS

``` json
200
```

## Gadgets

<h3>Phones - Get Request</h3>

ENDPOINT

``` json
"/api/phones"
```

PARAMETERS

``` txt

fields -  name, brand, price, tags, stock, description, hashid, id.
Example - "/api/phones?fields[]=name&fields[]=price&fields[]=brand"

hashid - arandomstring
Example - "/api/phones?hashid=arandomstring"

brand - brand of a phone e.g tecno, itel etc.
Example - "/api/phones?brand=vivo"

search - a text e.g brand new samsung galaxy s24
Example - "/api/phones?search=brand new samsung galaxy s24"

per_page - How many gadgets or products per page. Default value is 16.
Example - "/api/phones?per_page=20"

```

RESPONSE

```JSON
{
  "data": [
  {
      "id": 1,
      "hashid": "arandomstring",
      "name": "Tecno Spark 10 Pro",
      "price": 50000,
      "brand": "tecno",
      "tags": "black",
      "stock": 20,
      "description": "<p>Brand New Phone</p>",
      "media": [
          {
              "id": "a-random-string",
              "url": "https://yourimageurlorpath.example.com"
          }
      ]
  }
  ],
  "links": {
  "first": "https://mywebsite.com/api/phones?page=1",
  "last": "https://mywebsite.com/api/phones?page=1",
  "prev": null,
  "next": null
  },
  "meta": {
  "current_page": 1,
  "from": 1,
  "last_page": 1,
  "links": [
      {
          "url": null,
          "label": "&laquo; Previous",
          "active": false
      },
      {
          "url": "https://mywebsite.com/api/phones?page=1",
          "label": "1",
          "active": true
      },
      {
          "url": null,
          "label": "Next &raquo;",
          "active": false
      }
  ],
  "path": "https://mywebsite.com/api/phones",
  "per_page": 16,
  "to": 1,
  "total": 1
  }
}
```

STATUS

``` json
200
```

<h3>Computers - Get Request</h3>

ENDPOINT

``` json
"/api/pcs"
```

PARAMETERS

``` txt

fields -  name, brand, price, tags, stock, description, hashid, id.
Example - "/api/pcs?fields[]=name&fields[]=price&fields[]=brand"

hashid - arandomstring
Example - "/api/pcs?hashid=arandomstring"

brand - brand of a phone e.g dell, hp etc.
Example - "/api/pcs?brand=hp"

search - a text e.g Apple MacBook M4 Pro.
Example - "/api/pcs?search=Apple MacBook M4 Pro."

per_page - How many gadgets or products per page. Default value is 16.
Example - "/api/pcs?per_page=20"

```

RESPONSE

```JSON
{
  "data": [
  {
      "id": 1,
      "hashid": "arandomstring",
      "name": "Dell Latitude E7440 Windows 10 Pro.",
      "price": 50000,
      "brand": "tecno",
      "tags": "black",
      "stock": 20,
      "description": "<p>Brand New Laptop</p>",
      "media": [
          {
              "id": "a-random-string",
              "url": "https://yourimageurlorpath.example.com"
          }
      ]
  }
  ],
  "links": {
  "first": "https://mywebsite.com/api/pcs?page=1",
  "last": "https://mywebsite.com/api/pcs?page=1",
  "prev": null,
  "next": null
  },
  "meta": {
  "current_page": 1,
  "from": 1,
  "last_page": 1,
  "links": [
      {
          "url": null,
          "label": "&laquo; Previous",
          "active": false
      },
      {
          "url": "https://mywebsite.com/api/pcs?page=1",
          "label": "1",
          "active": true
      },
      {
          "url": null,
          "label": "Next &raquo;",
          "active": false
      }
  ],
  "path": "https://mywebsite.com/api/pcs",
  "per_page": 16,
  "to": 1,
  "total": 1
  }
}
```

STATUS

``` json
200
```

<h3>Tablets - Get Request</h3>

ENDPOINT

``` json
"/api/tablets"
```

PARAMETERS

``` txt

fields -  name, brand, price, tags, stock, description, hashid, id.
Example - "/api/tablets?fields[]=name&fields[]=price&fields[]=brand"

hashid - arandomstring
Example - "/api/tablets?hashid=arandomstring"

brand - brand of a phone e.g ipad, dell tablets etc.
Example - "/api/tablets?brand=dell"

search - a text e.g Brand New Dell Tablets
Example - "/api/tablets?search=brand new dell tablets"

per_page - How many gadgets or products per page. Default value is 16.
Example - "/api/tablets?per_page=26"

```

RESPONSE

```JSON
{
  "data": [
  {
      "id": 1,
      "hashid": "arandomstring",
      "name": "iPad 26",
      "price": 50000,
      "brand": "ipad",
      "tags": "silver",
      "stock": 88,
      "description": "<p>Brand New iPad</p>",
      "media": [
          {
              "id": "a-random-string",
              "url": "https://yourimageurlorpath.example.com"
          }
      ]
  }
  ],
  "links": {
  "first": "https://mywebsite.com/api/tablets?page=1",
  "last": "https://mywebsite.com/api/tablets?page=1",
  "prev": null,
  "next": null
  },
  "meta": {
  "current_page": 1,
  "from": 1,
  "last_page": 1,
  "links": [
      {
          "url": null,
          "label": "&laquo; Previous",
          "active": false
      },
      {
          "url": "https://mywebsite.com/api/tablets?page=1",
          "label": "1",
          "active": true
      },
      {
          "url": null,
          "label": "Next &raquo;",
          "active": false
      }
  ],
  "path": "https://mywebsite.com/api/tablets",
  "per_page": 16,
  "to": 1,
  "total": 1
  }
}
```

STATUS

``` json
200
```

<h3>Accessories - Get Request</h3>

ENDPOINT

``` json
"/api/accessories"
```

PARAMETERS

``` txt

fields -  name, price, tags, stock, description, hashid, id.
Example - "/api/accessories?fields[]=name&fields[]=price"

hashid - arandomstring
Example - "/api/accessories?hashid=arandomstring"

search - a text e.g Brand New PS5 Console.
Example - "/api/accessories?search=brand new ps5 console."

per_page - How many gadgets or products per page. Default value is 16.
Example - "/api/accessories?per_page=26"

```

RESPONSE

```JSON
{
  "data": [
  {
      "id": 1,
      "hashid": "arandomstring",
      "name": "iPad 26",
      "price": 50000,
      "tags": "white, new, ps5",
      "stock": 88,
      "description": "<p>Brand New PS5</p>",
      "media": [
          {
              "id": "a-random-string",
              "url": "https://yourimageurlorpath.example.com"
          }
      ]
  }
  ],
  "links": {
  "first": "https://mywebsite.com/api/accessories?page=1",
  "last": "https://mywebsite.com/api/accessories?page=1",
  "prev": null,
  "next": null
  },
  "meta": {
  "current_page": 1,
  "from": 1,
  "last_page": 1,
  "links": [
      {
          "url": null,
          "label": "&laquo; Previous",
          "active": false
      },
      {
          "url": "https://mywebsite.com/api/accessories?page=1",
          "label": "1",
          "active": true
      },
      {
          "url": null,
          "label": "Next &raquo;",
          "active": false
      }
  ],
  "path": "https://mywebsite.com/api/accessories",
  "per_page": 16,
  "to": 1,
  "total": 1
  }
}
```

STATUS

``` json
200
```

## Order

<!-- ORDER THE GOODS IN YOUR CART AND MAKE PAYMENT. -->
<h3>Order and Pay - Post Request</h3>

ENDPOINT
``` json
"/customer/order"
```

REQUEST

``` json
{
  "first_name": "John", // Required
  "last_name": "Doe", // Required
  "email": "john@gmail.com", // Required
  "phone_number": "08023456789", // Required - Phone Number should be a string.
  "address": "42nd Japa Street.", // Required
  "country": "Nigeria", // Required
  "apartment_name": "", //Optional
  "state": "Oyo", // Required
  "postal_code": , // Optional
  "city": "My City", // Required
}
```

RESPONSE

```json
{
  "success": true,
  "message": "https://redirect-url-for-payment"
}
```

STATUS

``` json
200
```
