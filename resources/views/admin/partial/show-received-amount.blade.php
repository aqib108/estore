<div>
    <form method="post" id="noteForm">
        @csrf
        <input type="hidden" class="donation-id" name="donation_id" id="donation_id" value="{{ $donation->id }}">
        <div class="form-outline">
            <label class="form-label" for="textAreaExample2">Received Amount</label>
            <input class="form-control note-des" name="received_amount" id="note" type="text" value="{{ !empty( $donation->received_amount)? $donation->received_amount:'' }}">
        </div>
    </form>
</div>
