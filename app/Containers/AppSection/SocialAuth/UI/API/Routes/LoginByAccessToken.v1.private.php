<?php

// https://developers.google.com/identity/protocols/oauth2/javascript-implicit-flow
// This endpoint is for web clients only (web apps, not native mobile apps)
// It expects a GET request with a query string containing the user's access token which was received from the social provider
// If user is not logged in, we throw an error
