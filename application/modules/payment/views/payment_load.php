<?php $this->load->view('home/header') ?>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/pymt.css"> -->

<link rel="stylesheet" href="<?php echo base_url(); ?>public/stripe/css/bootstrap-min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/stripe/css/bootstrap-formhelpers-min.css" media="screen">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/stripe/css/bootstrapValidator-min.css"/>
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/stripe/css/bootstrap-side-notes.css" />

<style type="text/css">
  .col-centered {
      display:inline-block;
      float:none;
      text-align:left;
      margin-right:-4px;
  }
  .row-centered {
  	margin-left: 9px;
  	margin-right: 9px;
  }
  #payment-form {
    padding: 20px 30px 30px;
    border-radius: 4px;
    border: 1px solid #e8e8fb;
    background: #f8fbfd;
  }
  section {
      display: flex;
      flex-direction: column;
      position: relative;
      text-align: left;
      padding: 10px;
  }
  fieldset {
      margin-bottom: 20px;
      background: #fff;
      box-shadow: 0 1px 3px 0 rgba(50, 50, 93, 0.15), 0 4px 6px 0 rgba(112, 157, 199, 0.15);
      border-radius: 4px;
      border: none;
      /*overflow: hidden;*/
      /* font-size: 0; */
  }
  legend {
      font-size: 18px;
  }
  button {
      display: block;
      background: #666ee8;
      color: #fff;
      box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
      border-radius: 4px;
      border: 0;
      font-weight: 700;
      width: 20%;
      height: 40px;
      outline: none;
      cursor: pointer;
      transition: all 0.15s ease;
  }
</style>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/stripe/js/bootstrap-min.js"></script>
<script src="<?php echo base_url(); ?>public/stripe/js/bootstrap-formhelpers-min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/stripe/js/bootstrapValidator-min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#payment-form').bootstrapValidator({
      message: 'This value is not valid',
      feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
      },
      submitHandler: function(validator, form, submitButton) {
        // createToken returns immediately - the supplied callback submits the form if there are no errors
        Stripe.card.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val(),
          name: $('.card-holder-name').val(),
          address_line1: $('.address').val(),
          address_city: $('.city').val(),
          address_zip: $('.zip').val(),
          address_state: $('.state').val(),
          address_country: $('.country').val()
        }, stripeResponseHandler);
        return false; // submit from callback
      },
      fields: {
        address: {
          validators: {
            notEmpty: {
              message: 'The address is required and cannot be empty'
            },
            stringLength: {
              min: 6,
              max: 96,
              message: 'The address must be more than 6 and less than 96 characters long'
            }
          }
        },
        city: {
          validators: {
            notEmpty: {
              message: 'The city is required and cannot be empty'
            }
          }
        },
        postal_code: {
          validators: {
            notEmpty: {
              message: 'The zip is required and cannot be empty'
            },
            stringLength: {
              min: 3,
              max: 9,
              message: 'The zip must be more than 3 and less than 9 characters long'
            }
          }
        },
        email: {
          validators: {
            notEmpty: {
              message: 'The email address is required and can\'t be empty'
            },
            emailAddress: {
              message: 'The input is not a valid email address'
            },
            stringLength: {
              min: 6,
              max: 65,
              message: 'The email must be more than 6 and less than 65 characters long'
            }
          }
        },
        name: {
          validators: {
            notEmpty: {
              message: 'The card holder name is required and can\'t be empty'
            },
            stringLength: {
              min: 6,
              max: 70,
              message: 'The card holder name must be more than 6 and less than 70 characters long'
            }
          }
        },
        cardnumber: {
          selector: '#cardnumber',
          validators: {
            notEmpty: {
              message: 'The credit card number is required and can\'t be empty'
            },
            creditCard: {
              message: 'The credit card number is invalid'
            },
          }
        },
        expMonth: {
          selector: '[data-stripe="exp-month"]',
          validators: {
            notEmpty: {
              message: 'The expiration month is required'
            },
            digits: {
              message: 'The expiration month can contain digits only'
            },
            callback: {
              message: 'Expired',
              callback: function(value, validator) {
                value = parseInt(value, 10);
                var year         = validator.getFieldElements('expYear').val(),
                currentMonth = new Date().getMonth() + 1,
                currentYear  = new Date().getFullYear();
                if (value < 0 || value > 12) {
                  return false;
                }
                if (year == '') {
                  return true;
                }
                year = parseInt(year, 10);
                if (year > currentYear || (year == currentYear && value > currentMonth)) {
                  validator.updateStatus('expYear', 'VALID');
                  return true;
                } else {
                  return false;
                }
              }
            }
          }
        },
        expYear: {
          selector: '[data-stripe="exp-year"]',
          validators: {
            notEmpty: {
              message: 'The expiration year is required'
            },
            digits: {
              message: 'The expiration year can contain digits only'
            },
            callback: {
              message: 'Expired',
              callback: function(value, validator) {
                value = parseInt(value, 10);
                var month        = validator.getFieldElements('expMonth').val(),
                currentMonth = new Date().getMonth() + 1,
                currentYear  = new Date().getFullYear();
                if (value < currentYear || value > currentYear + 100) {
                  return false;
                }
                if (month == '') {
                  return false;
                }
                month = parseInt(month, 10);
                if (value > currentYear || (value == currentYear && month > currentMonth)) {
                  validator.updateStatus('expMonth', 'VALID');
                  return true;
                } else {
                  return false;
                }
              }
            }
          }
        },
        cvv: {
          selector: '#cvv',
          validators: {
            notEmpty: {
              message: 'The cvv is required and can\'t be empty'
            },
            cvv: {
              message: 'The value is not a valid CVV',
              creditCardField: 'cardnumber'
            }
          }
        },
      }
    });
  });
</script>
<script type="text/javascript">
  // this identifies your website in the createToken call below
  Stripe.setPublishableKey('<?php echo $publishable_key ?>');
  function stripeResponseHandler(status, response) {
    if (response.error) {
      // re-enable the submit button
      $('.submit-button').removeAttr("disabled");
      // show hidden div
      document.getElementById('a_x200').style.display = 'block';
      // show the errors on the form
      $(".payment-errors").html(response.error.message);
      $("body,html").animate({
            scrollTop : 50
      }, 200);
    } else {
      var form$ = $("#payment-form");
      // token contains id, last4, and card type
      var token = response['id'];
      // insert the token into the form so it gets submitted to the server
      form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
      // and submit
      form$.get(0).submit();
    }
  }
</script>
</head>
<body>
  <?php
    $search_details=$this->session->userdata('search_details');
    $pass_info=$this->session->userdata('passenger_info');
    // echo '<pre>'; print_r($pass_info);exit;
  ?>
  <form method="POST" id="payment-form" class="form-horizontal"  action="<?php echo site_url() ?>payment/payment_return" enctype="multipart/form-data">
    <div class="row row-centered">
      <div class="col-md-6 col-md-offset-3">
        <!-- <div class="page-header">
          <h2 class="gdfg">Secure Payment Form</h2>
        </div> -->
        <noscript>
          <div class="bs-callout bs-callout-danger">
            <h4>JavaScript is not enabled!</h4>
            <p>This payment form requires your browser to have JavaScript enabled. Please activate JavaScript and reload this page. Check <a href="http://enable-javascript.com" target="_blank">enable-javascript.com</a> for more informations.</p>
          </div>
        </noscript>
        <div class="alert alert-danger" id="a_x200" style="display: none;">
          <strong>Error!</strong> <span class="payment-errors"></span>
        </div>
        <fieldset>
          <section>
            <!-- Form Name -->
            <legend>Billing Details</legend>
            <!-- Address -->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="textinput">Address</label>
              <div class="col-sm-6">
                <input type="text" value="<?php echo $pass_info['GuestAddress'] ?>" name="address" placeholder="Address" class="address form-control">
              </div>
            </div>
            <!-- City -->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="textinput">City</label>
              <div class="col-sm-6">
                <input type="text" value="<?php echo $pass_info['GuestCity'] ?>" name="city" placeholder="City" class="city form-control">
              </div>
            </div>
            <!-- State -->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="textinput">State</label>
              <div class="col-sm-6">
                <input type="text" value="<?php echo $pass_info['GuestState'] ?>" name="state" maxlength="65" placeholder="State" class="state form-control">
              </div>
            </div>
            <!-- Postcal Code -->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="textinput">Postal Code</label>
              <div class="col-sm-6">
                <input type="text" value="<?php echo $pass_info['GuestPostalCode'] ?>" name="postal_code" maxlength="9" placeholder="Postal Code" class="zip form-control">
              </div>
            </div>
            <!-- Country -->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="textinput">Country</label>
              <div class="col-sm-6">
                <!--input type="text" name="country" placeholder="Country" class="country form-control"-->
                <div class="country bfh-selectbox bfh-countries" name="country" placeholder="Select Country" data-flags="true" data-filter="true"> </div>
              </div>
            </div>
            <!-- Email -->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="textinput">Email</label>
              <div class="col-sm-6">
                <input type="text" value="<?php echo $pass_info['GuestEmailID'] ?>" name="email" maxlength="65" placeholder="Email" class="email form-control">
              </div>
            </div>
          </section>
        </fieldset>
        <fieldset>
          <section>
            <legend>Card Details</legend>
            <!-- Card Holder Name -->
            <div class="form-group">
              <label class="col-sm-4 control-label"  for="textinput">Card Holder's Name</label>
              <div class="col-sm-6">
                <input type="text" name="name" maxlength="70" placeholder="Card Holder Name" value="<?php echo $pass_info['GuestFirstName'].' '.$pass_info['GuestLastName'] ?>" class="card-holder-name form-control">
              </div>
            </div>
            <!-- Card Number -->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="textinput">Card Number</label>
              <div class="col-sm-6">
                <input type="text" id="cardnumber" maxlength="19" placeholder="Card Number" class="card-number form-control">
              </div>
            </div>
            <!-- Expiry-->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="textinput">Card Expiry Date</label>
              <div class="col-sm-6">
                <div class="form-inline">
                  <select name="select2" data-stripe="exp-month" class="card-expiry-month stripe-sensitive required form-control">
                    <option value="01" selected="selected">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>
                  <span> / </span>
                  <select name="select2" data-stripe="exp-year" class="card-expiry-year stripe-sensitive required form-control">
                  </select>
                  <script type="text/javascript">
                    var select = $(".card-expiry-year"),
                    year = new Date().getFullYear();
                    for (var i = 0; i < 12; i++) {
                    select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
                    }
                  </script>
                </div>
              </div>
            </div>
            <!-- CVV -->
            <div class="form-group">
              <label class="col-sm-4 control-label" for="textinput">CVV/CVV2</label>
              <div class="col-sm-3">
                <input type="text" id="cvv" placeholder="CVV" maxlength="4" class="card-cvc form-control">
              </div>
            </div>
            <!-- Important notice -->
            <div class="form-group">
              <!-- <div class="panel panel-success">
                <div class="panel-heading">
                  <h3 class="panel-title">Important notice</h3>
                </div>
                <div class="panel-body">
                  <p>Your card will be charged 30€ after submit.</p>
                  <p>Your account statement will show the following booking text:
                  XXXXXXX</p>
                </div>
              </div> -->
              <!-- Submit -->
              <div class="control-group">
                <div class="controls">
                  <center>
                    <!-- <div>Test card: 4242424242424242</div><br> -->
                    <button class="" type="submit">Pay <?php echo number_format($search_details['cost'],2) ?></button>
                  </center>
                </div>
              </div>
            </div>
          </section>
        </fieldset>
      </div>
    </div>
  </form>
</body>
</html>
