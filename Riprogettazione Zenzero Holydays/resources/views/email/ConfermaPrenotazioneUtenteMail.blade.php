<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Conferma di Prenotazione</title>
    </head>

    <body>
        <h1>{{ $mailData['title'] }}</h1>
        <p>Caro {{ $mailData['nome'] }} {{ $mailData['cognome'] }},</p>
        <p>{{ $mailData['body'] }}</p>

        <p><strong>Dettagli della tua prenotazione:</strong></p>
        <ul>
            <li><strong>Data di arrivo:</strong> {{ $mailData['arrivo'] }}</li>
            <li><strong>Data di partenza:</strong> {{ $mailData['partenza'] }}</li>
            <li><strong>Prezzo Totale:</strong> €{{ $mailData['prezzoTotale'] }}</li>
            <br>
            <li><strong>Nome:</strong> {{ $mailData['nome'] }} {{ $mailData['cognome'] }}</li>
            <li><strong>Email:</strong> {{ $mailData['email'] }}</li>
            <li><strong>Telefono:</strong> {{ $mailData['telefono'] }}</li>
            <li><strong>Stato:</strong> {{ $mailData['stato'] }}</li>
            <li><strong>Ospiti:</strong> {{ $mailData['numAdulti'] }} adulti e {{ $mailData['numBambini'] }} bambini</li>
            <li><strong>Orario di arrivo:</strong> {{ $mailData['orario'] }}</li>
        </ul>
        <p>Grazie per aver scelto Zenzero Holidays! Non vediamo l'ora di accoglierti. Per qualsiasi domanda, non esitare a contattarci.</p>
        <p>Distinti saluti,<br>Christian Girardelli - Zenzero Holidays</p>
    </body>
</html>