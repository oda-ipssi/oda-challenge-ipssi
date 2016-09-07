
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>

    <body>
        <h1>Invoice {{ $payment->id }}</h1>
        <h2>Payment information</h2>
        <p>Payment method : {{ $payment->paymentMethod }}</p>
        <p>Card number : {{ $payment->cardNumber }}</p>
        <p>Expiration date : {{ $payment->expirationDate }}</p>

        <h2>Billing details</h2>
        <p><b> {{ $user->lastname }} {{ $user->firstname }}</b></p>
        <p>{{ $user->address }}</p>
        <p>{{ $user->zipcode }}</p>
        <p>{{ $user->city }}'</p>
        <p>{{ $user->phone }}</p>

        <h2>Order summary</h2>
        <table width="200"  align="left">
            <tr>
                <th>Offer</th>
                <th>Database limit</th>
                <th>Price</th>
            </tr>

            <tr>
                <td>{{ $offer->title }}</td>
                <td>{{ $offer->database_limit }}</td>
                <td>{{ $offer->price }}€</td>
            </tr>
        </table>
    </body>
<html>