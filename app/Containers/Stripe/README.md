# Stripe Porto Container for Hello API

### How it works:

1. the front-end app shows the stripe form (can use "Stripe Checkout" or "Stripe.js").
2. the user fill the form (enter his credit card details..).
3. the front-end app send a request to the stripe api to create a user with credit card.
4. the stripe api returns data including (customer_id, card_id, card_funding, card_last_digits, card_fingerprint) to the front-end app.
5. the front-end app send the stripe api response data to the back-end (POST https://api.hello.com/stripes) to be stored.
6. the user select an item to buy.
7. the front-end sends the item ID "item_id" to the back-end (POST https://api.hello.com/items/purchase).
8. the back-end finds the logged in user and gets his stripe customer_id, and finds the item price by its ID, for the next step.
9. the back-end send a request to the stripe api to charge the user (using the customer id and the item amount).
10. the back-end api returns OK response informing the front-end app that the user was charged.
