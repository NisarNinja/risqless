<div class="card border-0 shadow-lg b-radius">
    <div class="card-body p-0 d-flex justify-content-center fake-upload" >
                            
        <img src="{{asset('images/fake-upload.png')}}" alt="" width="95%" style="opacity: 0.2">
        <h4>You should strat trial in order to upload files.</h4>
        <button class="btn btn-upload" data-toggle="modal" data-target="#stripe-modal">Start 7 Day Trial</button>                 
    </div>
</div>


 <!-- Modal -->
<div class="modal fade" id="stripe-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Card Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('processSubscription') }}" method="POST" id="subscribe-form" >
          @csrf
            <div class="form-group">
                <div class="row">
                    @foreach($plans as $plan)
                    <div class="col-md-4 d-none">
                        <div class="subscription-option">
                            <input type="radio" id="plan-silver" name="plan" value="{{$plan->id}}" checked  />
                            <label for="plan-silver">
                                <span class="plan-price">{{$plan->currency}}{{$plan->amount/100}}<small> /{{$plan->interval}}</small></span>
                                <span class="plan-name">{{$plan->product->name}}</span>
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label for="card-holder-name">Card Holder Name</label>
                <input id="card-holder-name" type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Name" >
            </div>

            <div class="form-row">
                <label for="card-element">Credit or debit card</label>
                <div id="card-element" class="form-control"></div>
                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
            </div>
            <div class="stripe-errors"></div>
            @if ($errors->has('subscription_error'))
            <div class="alert alert-danger">
                {{ $errors->first('subscription_error') }}
            </div>
            @endif
            <div class="form-group text-center">
                <button id="card-button" data-secret="{{ ($intent !== null)? $intent->client_secret : '' }}" class="btn btn-upload w-100 mt-4 mb-3">Start 7 Day Trail</button>
            </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>


    var stripe = Stripe(`{{ \config('services.stripe.key') }}`);
    var elements = stripe.elements();


    var style = {
        base: {
            color: '#32325d',
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
    var card = elements.create('card', {hidePostalCode: true,
        style: style});
    

    card.mount('#card-element');
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');

    

    const clientSecret = cardButton.dataset.secret;
    cardButton.addEventListener('click', async(e) => {
        e.preventDefault();

        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: card,
                    billing_details: { name: cardHolderName.value }
                }
            }
            );
        if (error) {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
        } else {

            paymentMethodHandler(setupIntent.payment_method);
        }
    });
    function paymentMethodHandler(payment_method) {
        var form = document.getElementById('subscribe-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'payment_method');
        hiddenInput.setAttribute('value', payment_method);
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>