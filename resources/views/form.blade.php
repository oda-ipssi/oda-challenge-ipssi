Montant : {{ $fields["vads_amount"]/100 }}<br />
ID de transaction : {{ $fields['vads_trans_id'] }} <br />
<form method="POST" action="https://secure.payzen.eu/vads-payment/" >
    @foreach ($fields as $fieldName => $field)
        <input type="hidden" name="{{ $fieldName }}" value="{{ $field }}" />
    @endforeach
    <input type="hidden" name="signature" value="{{ $signature }}" />
    <button>Payer</button>
</form>