(async () => {
  'use strict';

  const form = document.getElementById('payment-form');
  const submitButton = form.querySelector('button[type=submit]');
  const errorElement = document.getElementById('card-errors');

  const config = {
    country: '',
    amount: '',
    currency: '',
    publishableKey: 'pk_test_iAH41GROAKolcgQlxHd4qZ71',
    secretKey: '',
    orderID: ""
  };

  // Create a Stripe client.
  var stripe = Stripe(config.publishableKey);
  // Create an instance of Elements.
  var elements = stripe.elements();

  // Custom styling can be passed to options when creating an Element.
  var style = {
    base: {
      color: '#32325d',
      // lineHeight: '18px',
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: 'antialiased',
      fontSize: '16px',
      '::placeholder': {
        color: '#aab7c4'
      }
    },
    invalid: {
      color: '#fa755a',
      iconColor: '#fa755a'
    }
  };
  // Create an instance of the card Element.
  var card = elements.create('card', {style: style}, {class: 'StripeElement'});
  // Add an instance of the card Element into the `card-element` <div>.
  card.mount('#card-element');


  card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
      displayError.classList.add('visible');
      displayError.textContent = event.error.message;
    } else {
      displayError.classList.remove('visible');
      displayError.textContent = '';
    }
  });


  // Create a token or display an error when the form is submitted.
  form.addEventListener('submit', function(event) {
    event.preventDefault();
    // submitButton.textContent = 'Processing Payment…';
    submitButton.disabled = true;
    const ownerInfo = {
      owner: {
        name: form.querySelector('input[name=name]').value,
        address: {
          line1: form.querySelector('input[name=address]').value,
          city: form.querySelector('input[name=city]').value,
          postal_code: form.querySelector('input[name=postal_code]').value,
          country: form.querySelector('select[name=country] option:checked').value,
        },
        email: form.querySelector('input[name=email]').value
      },
    };
    
    stripe.createSource(card, ownerInfo).then(function(results) {
      // console.log(results);//return false;
      // handleOrder(result);
      if (results.error) {
        let result = results.error;
        // Inform the user if there was an error.
        // var errorElement = document.getElementById('card-errors');
        // errorElement.textContent = result.message;
        const mainElement2 = document.getElementById('main');
        mainElement2.classList.add('error');
        console.log(result);//return false;
      } else {
        let result = results.source;
        handleOrder(result);
      }
    });

  });



  // Handle the order and source activation if required
  function handleOrder(result) {
    console.log(result);//return false;
    // const mainElement = document.getElementById('main');
    // const confirmationElement = document.getElementById('confirmation');
    switch (result.status) {
      case 'chargeable':
        submitButton.textContent = 'Processing Payment…';
        stripeOrderHandler(result);
        break;
      case 'pending':
        // console.log(source);return false;
        switch (result.flow) {
          case 'redirect':
            // Immediately redirect the customer.
            submitButton.textContent = 'Redirecting…';
            window.location.replace(result.redirect.url);
            break;
          default:
            // Order is received, pending payment confirmation.
            break;
        }
        break;
      case 'failed':
      case 'canceled':
        // Authentication failed, offer to select another payment method.
        break;
      default:
        // console.log(source);return false;
        // Order is received, pending payment confirmation.
        break;
    }
  };

  // Complete payment for an order using a source.
  function stripeOrderHandler(source) {
    // let {source} = req.body;
    // console.log(source);
    // Dynamically evaluate if 3D Secure should be used.
    if (source && source.type === 'card') {
      // A 3D Secure source may be created referencing the card source.
      // source = dynamic3DS(source);
    }
    // Demo: In test mode, replace the source with a test token so charges can work.
    if (!source.livemode) {
      // source.id = 'tok_visa';
    }
    // Pay the order using the Stripe source.
    if (source && source.status === 'chargeable') {
      stripe.createToken(card).then(function(result) {
        // console.log(result);
        var errorElement = document.getElementById('card-errors');
        if (result.error) {
          submitButton.disabled = false;
          // Inform the customer that there was an error.
          errorElement.classList.add('visible');
          errorElement.textContent = result.error.message;
        } else {
          errorElement.classList.remove('visible');
          errorElement.textContent = ''
          // Send the token to your server.
          stripeTokenHandler(result.token, source);
        }
      });
    }
  }

  function stripeTokenHandler(token, source) {
    // Insert the token ID into the form so it gets submitted to the server
    var hiddenInput = document.createElement('input');
    var hiddenInput2 = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    hiddenInput2.setAttribute('type', 'hidden');
    hiddenInput2.setAttribute('name', 'stripeSource');
    hiddenInput2.setAttribute('value', source.id);
    form.appendChild(hiddenInput2);

    // Submit the form
    form.submit();
  }


})();