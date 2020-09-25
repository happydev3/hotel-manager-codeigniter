(async () => {


'use strict';

	// Create references to the main form and its submit button.
	const form = document.getElementById('payment-form');
	const submitButton = form.querySelector('button[type=submit]');
  const idtype = document.getElementById('idtype');
  
	const config = {
		country: 'US',
		amount: idtype,
		currency: 'usd',
		publishableKey: 'pk_test_iAH41GROAKolcgQlxHd4qZ71',
    orderID: "SKA92712382139"
	};

// Create a Stripe client.
var stripe = Stripe(config.publishableKey);
// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
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

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
// var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();
  	// Retrieve the user information from the form.
    const payment = form.querySelector('input[name=payment]:checked').value;
    const name = form.querySelector('input[name=name]').value;
    const country = form.querySelector('select[name=country] option:checked').value;
    const email = form.querySelector('input[name=email]').value;
    const shipping = {
      name,
      address: {
        line1: form.querySelector('input[name=address]').value,
        city: form.querySelector('input[name=city]').value,
        postal_code: form.querySelector('input[name=postal_code]').value,
        state: form.querySelector('input[name=state]').value,
        country,
      },
    };
    // Disable the Pay button to prevent multiple click events.
    submitButton.disabled = true;
    // Create the order using the email and shipping information from the form.
    // const order = stripe.createOrder(
    //   config.currency,
    //   config.orderID,
    //   email,
    //   shipping
    // );

    // console.log(order);return false;
    if (payment === 'card') {
      // Create a Stripe source from the card information and the owner name.
      const ownerInfo = {
        owner: {
          name: name,
          address: {
            line1: form.querySelector('input[name=address]').value,
            city: form.querySelector('input[name=city]').value,
            postal_code: form.querySelector('input[name=postal_code]').value,
            country: country
          },
          email: email
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
      
    } else {
      // Prepare all the Stripe source common data.
      const sourceData = {
        type: payment,
        amount: config.amount,
        currency: config.currency,
        owner: {
          name,
          email,
        },
        redirect: {
          return_url: window.location.href,
        },
        statement_descriptor: 'Stripe Payments Demo',
        metadata: {
          order: config.orderID,
        },
      };

      // Add extra source information which are specific to a payment method.
      switch (payment) {
        case 'sepa_debit':
          // SEPA Debit: Pass the IBAN entered by the user.
          sourceData.sepa_debit = {
            iban: form.querySelector('input[name=iban]').value,
          };
          break;
        case 'sofort':
          // SOFORT: The country is required before redirecting to the bank.
          sourceData.sofort = {
            country,
          };
          break;
        case 'ach_credit_transfer':
          // ACH Bank Transfer: Only supports USD payments, edit the default config to try it.
          // In test mode, we can set the funds to be received via the owner email.
          sourceData.owner.email = `amount_${config.amount}@example.com`;
          break;
      }

      // Create a Stripe source with the common data and extra information.
      // const source = stripe.createSource(sourceData);
      stripe.createSource(sourceData).then(function(results) {
        // console.log(results);//return false;
        // handleOrder(result);
        if (results.error) {
          let result = results.error;
          // Inform the user if there was an error.
          // var errorElement = document.getElementById('card-errors');
          // errorElement.textContent = result.message;
          const mainElement3 = document.getElementById('main');
          mainElement3.classList.add('error');
          console.log(result);//return false;
        } else {
          let result = results.source;
          handleOrder(result);
        }
      });
      // console.log(source);return false;
      // handleOrder(source);
    }

});

// function handleOrder(){
// 	stripe.createToken(card).then(function(result) {
//   	console.log(result);
//     if (result.error) {
//       // Inform the user if there was an error.
//       var errorElement = document.getElementById('card-errors');
//       errorElement.textContent = result.error.message;

//     } else {
//       // Send the token to your server.
//       stripeTokenHandler(result.token);
//     }
//   });
// }


  // Handle the order and source activation if required
  function handleOrder(result) {
    // console.log(result);//return false;
    const mainElement = document.getElementById('main');
    const confirmationElement = document.getElementById('confirmation');

    switch (result.status) {
      case 'chargeable':
        submitButton.textContent = 'Processing Payment…';
        // const response = await store.payOrder(result);
        // await handleOrder(response.order, response.source);
        // console.log(result.status);return false;
        stripeOrderHandler(result);
        break;
      case 'pending':
        // console.log(source);return false;
        switch (result.flow) {
          case 'none':
            // Normally, sources with a `flow` value of `none` are chargeable right away,
            // but there are exceptions, for instance for WeChat QR codes just below.
            if (result.type === 'wechat') {
              // Display the QR code.
              const qrCode = new QRCode('wechat-qrcode', {
                text: result.wechat.qr_code_url,
                width: 128,
                height: 128,
                colorDark: '#424770',
                colorLight: '#f8fbfd',
                correctLevel: QRCode.CorrectLevel.H,
              });
              // Hide the previous text and update the call to action.
              form.querySelector('.payment-info.wechat p').style.display =
                'none';
              let amount = store.formatPrice(
                store.getOrderTotal(),
                config.currency
              );
              submitButton.textContent = `Scan this QR code on WeChat to pay ${amount}`;
              // Start polling the order status.
              pollOrderStatus(order.id, 300000);
            } else {
              console.log('Unhandled none flow.', result);
            }
            break;
          case 'redirect':
            // Immediately redirect the customer.
            submitButton.textContent = 'Redirecting…';
            window.location.replace(result.redirect.url);
            break;
          case 'code_verification':
            // Display a code verification input to verify the result.
            break;
          case 'receiver':
            // Display the receiver address to send the funds to.
            mainElement.classList.add('success', 'receiver');
            const receiverInfo = confirmationElement.querySelector('.receiver .info');
            let amount = formatPrice(result.amount, config.currency);
            switch (result.type) {
              case 'ach_credit_transfer':
                // Display the ACH Bank Transfer information to the user.
                console.log(receiverInfo);
                const ach = result.ach_credit_transfer;
                receiverInfo.innerHTML = `
                  <ul>
                    <li>
                      Amount:
                      <strong>${amount}</strong>
                    </li>
                    <li>
                      Bank Name:
                      <strong>${ach.bank_name}</strong>
                    </li>
                    <li>
                      Account Number:
                      <strong>${ach.account_number}</strong>
                    </li>
                    <li>
                      Routing Number:
                      <strong>${ach.routing_number}</strong>
                    </li>
                  </ul>`;
                break;
              case 'multibanco':
                // Display the Multibanco payment information to the user.
                const multibanco = result.multibanco;
                receiverInfo.innerHTML = `
                  <ul>
                    <li>
                      Amount (Montante):
                      <strong>${amount}</strong>
                    </li>
                    <li>
                      Entity (Entidade):
                      <strong>${multibanco.entity}</strong>
                    </li>
                    <li>
                      Reference (Referencia):
                      <strong>${multibanco.reference}</strong>
                    </li>
                  </ul>`;
                break;
              default:
                console.log('Unhandled receiver flow.', source);
            }
            // Poll the backend and check for an order status.
            // The backend updates the status upon receiving webhooks,
            // specifically the `source.chargeable` and `charge.succeeded` events.
            // pollOrderStatus(order.id);
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


  function stripeTokenHandler(token, source) {
    // Insert the token ID into the form so it gets submitted to the server
    // var form = document.getElementById('payment-form');
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
	
	/**
   * Display the relevant payment methods for a selected country.
   */

  // List of relevant countries for the payment methods supported in this demo.
  // Read the Stripe guide: https://stripe.com/payments/payment-methods-guide
  const paymentMethods = {
    ach_credit_transfer: {
      name: 'Bank Transfer',
      flow: 'receiver',
      countries: ['US'],
    },
    alipay: {
      name: 'Alipay',
      flow: 'redirect',
      countries: ['CN', 'HK', 'SG', 'JP'],
    },
    bancontact: {
      name: 'Bancontact',
      flow: 'redirect',
      countries: ['BE'],
    },
    card: {
      name: 'Card',
      flow: 'none',
    },
    eps: {
      name: 'EPS',
      flow: 'redirect',
      countries: ['AT'],
    },
    ideal: {
      name: 'iDEAL',
      flow: 'redirect',
      countries: ['NL'],
    },
    giropay: {
      name: 'Giropay',
      flow: 'redirect',
      countries: ['DE'],
    },
    multibanco: {
      name: 'Multibanco',
      flow: 'receiver',
      countries: ['PT'],
    },
    sepa_debit: {
      name: 'SEPA Direct Debit',
      flow: 'none',
      countries: ['FR', 'DE', 'ES', 'BE', 'NL', 'LU', 'IT', 'PT', 'AT', 'IE'],
    },
    sofort: {
      name: 'SOFORT',
      flow: 'redirect',
      countries: ['DE', 'AT'],
    },
    wechat: {
      name: 'WeChat',
      flow: 'none',
      countries: ['CN', 'HK', 'SG', 'JP'],
    },
  };


	// Update the main button to reflect the payment method being selected.
  const updateButtonLabel = paymentMethod => {
    let amount = formatPrice(config.amount, config.currency);
    let name = paymentMethods[paymentMethod].name;
    let label = `Pay ${amount}`;
    if (paymentMethod !== 'card') {
      label = `Pay ${amount} with ${name}`;
    }
    if (paymentMethod === 'wechat') {
      label = `Generate QR code to pay ${amount} with ${name}`;
    }
    submitButton.innerText = label;
  };

  // Show only the payment methods that are relevant to the selected country.
  const showRelevantPaymentMethods = country => {
    if (!country) {
      country = form.querySelector('select[name=country] option:checked').value;
    }
    const paymentInputs = form.querySelectorAll('input[name=payment]');
    for (let i = 0; i < paymentInputs.length; i++) {
      let input = paymentInputs[i];
      input.parentElement.classList.toggle(
        'visible',
        input.value === 'card' ||
          paymentMethods[input.value].countries.includes(country)
      );
    }

    // Hide the tabs if card is the only available option.
    const paymentMethodsTabs = document.getElementById('payment-methods');
    paymentMethodsTabs.classList.toggle(
      'visible',
      paymentMethodsTabs.querySelectorAll('li.visible').length > 1
    );

    // Check the first payment option again.
    paymentInputs[0].checked = 'checked';
    form.querySelector('.payment-info.card').classList.add('visible');
    form.querySelector('.payment-info.sepa_debit').classList.remove('visible');
    form.querySelector('.payment-info.wechat').classList.remove('visible');
    form.querySelector('.payment-info.redirect').classList.remove('visible');
    updateButtonLabel(paymentInputs[0].value);
  };

  // Listen to changes to the payment method selector.
  for (let input of document.querySelectorAll('input[name=payment]')) {
    input.addEventListener('change', event => {
      event.preventDefault();
      const payment = form.querySelector('input[name=payment]:checked').value;
      const flow = paymentMethods[payment].flow;

      // Update button label.
      updateButtonLabel(event.target.value);

      // Show the relevant details, whether it's an extra element or extra information for the user.
      form
        .querySelector('.payment-info.card')
        .classList.toggle('visible', payment === 'card');
      form
        .querySelector('.payment-info.sepa_debit')
        .classList.toggle('visible', payment === 'sepa_debit');
      form
        .querySelector('.payment-info.wechat')
        .classList.toggle('visible', payment === 'wechat');
      form
        .querySelector('.payment-info.redirect')
        .classList.toggle('visible', flow === 'redirect');
      form
        .querySelector('.payment-info.receiver')
        .classList.toggle('visible', flow === 'receiver');
      document
        .getElementById('card-errors')
        .classList.remove('visible', payment !== 'card');
    });
  }

  // Select the default country from the config on page load.
  const countrySelector = document.getElementById('country');
  countrySelector.querySelector(`option[value=${config.country}]`).selected =
    'selected';
  countrySelector.className = `field ${config.country}`;

  // Trigger the method to show relevant payment methods on page load.
  showRelevantPaymentMethods();

  // Format a price (assuming a two-decimal currency like EUR or USD for simplicity).
  function formatPrice(amount, currency) {
    let price = (amount / 100).toFixed(2);
    let numberFormat = new Intl.NumberFormat(['en-US'], {
      style: 'currency',
      currency: currency,
      currencyDisplay: 'symbol',
    });
    return numberFormat.format(price);
  }


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
       console.log(result);
        if (result.error) {
          // Inform the user if there was an error.
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;

        } else {
          // Send the token to your server.
          stripeTokenHandler(result.token, source);
        }
      });
    }
  }

  // Dynamically create a 3D Secure source.
  function dynamic3DS(source){
    // Check if 3D Secure is required, or trigger it based on a custom rule (in this case, if the amount is above a threshold).
    if (source.card.three_d_secure === 'required') {
      source = stripe.sources.create({
        amount: config.amount,
        currency: config.currency,
        type: 'three_d_secure',
        three_d_secure: {
          card: source.id,
        },
        metadata: {
          order: config.orderID,
        },
        redirect: {
          // return_url: req.headers.origin,
        },
      });
    }
    return source;
  };

})();