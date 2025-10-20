<h1 align="center">GADGETS HUB E-COMMERCE API</h1>

A Demo API for a brand that deals on all kinds of gadgets. Built with the <strong>Laravel Framework.</strong>

<h2 align="center">Table of Contents</h2>

-   **[Installation and Setup](#installation-and-setup)**
-   **[Authentication](#authentication)**
-   **[Cart](#cart)**
-   **[Gadgets](#gadgets)**
-   **[Order](#order)**

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
<p>Registration - Post Request</p>

```JSON
ENDPOINT
"/customer/register"

REQUEST

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
}

RESPONSE

{
  "success": true,
  "message": "Your account was created successfully."
}

STATUS
201
```

<!-- LOGIN -->
<p>Login - Post Request</p>

```JSON
ENDPOINT
"/customer/login"

REQUEST

{
  "email": "john@example.com",
  "password": "password123",
}

RESPONSE

{
  "success": true,
  "message": "Login successful."
}

STATUS
200
```

<!-- CURRENTLY LOGGED IN CUSTOMER -->
<p>Logged In Customer - Get Request</p>

```JSON
ENDPOINT
"/customer"

RESPONSE

{
  "success": true,
  "message": 
  [
    "name": "John Doe",
    "email": "john@gmail.com",
  ]
}

STATUS
200
```

<!-- LOGOUT -->
<p>Logout - Post Request</p>

```JSON
ENDPOINT
"/customer/logout"

REQUEST

RESPONSE

{
  "message": "Logged out."
}

STATUS
200
```

## Cart

<p>You must have an account and be logged in before using the cart feature.</p>

<!-- ADD TO CART -->
<p>Add to Cart - Post Request</p>

```JSON
ENDPOINT
"/cart/add"

REQUEST

{
  "name": "Brand New PS5 Gaming Setup",
  "imagePath": "https://yourimagepath.example.com",
  "productId": 247 // Primary key of the product in the DB. Of course this is sanitized and re-validated.
}

RESPONSE

{
  "success": true,
  "message": "Added to Cart."
}

STATUS
200
```

<!-- SHOW CART - All Cart Items In A Customer's Cart -->
<p>Show Cart - Get Request</p>

```JSON
ENDPOINT
"/cart/show"

RESPONSE

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

STATUS
200
```

<!-- UPDATE CART -->
<p>Update Cart - Patch Request</p>

```JSON
ENDPOINT
"/cart/update"

REQUEST

{
  "name": "Digital HD Camera",
  "productId": 44,
  "quantity": 102,
}

```

<!-- REMOVE FROM CART -->
<p>Remove from cart - Post Request</p>

```JSON
ENDPOINT
"/cart/remove"

REQUEST

{
  "name": "Pink Headset",
  "productId": 6,
}

RESPONSE

{
  "success": true,
  "message": "Removed from cart."
}

STATUS
200
```

<!-- GET PRICE TOTAL FROM THE DB -->
<p>Estimated Total Price - Get Request</p>

```JSON
ENDPOINT
"/cart/total"

RESPONSE

{
  "message": 20000.00 // 20,0000
}

STATUS
200
```

## Gadgets

<li>Phones</li>

<li>Computers</li>

<li>Tablets</li>

<li>Other Accessories</li>

## Order

<!-- ORDER THE GOODS IN YOUR CART AND MAKE PAYMENT. -->
<p>Order and Pay - Post Request</p>

```JSON
ENDPOINT
"/customer/order"

REQUEST

{
  "first_name": "John", // Required
  "last_name": "Doe", // Required
  "email": "john@gmail.com", // Required
  "phone_number": "08023456789", // Required - Phone Number should be a string.
  "address": "42nd Japa Street.", // Required
  "country": "Nigeria", // Required
  "apartment_name": "", // Optional
  "state": "Oyo", // Required
  "postal_code": , // Optional
  "city": "My City", // Required
}

RESPONSE
{
  "success": true,
  "message": "https://redirect-url-for-payment"
}

STATUS
200
```
