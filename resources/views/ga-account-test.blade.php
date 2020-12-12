<!DOCTYPE html>
<html>
    <head>
        <title>Test account</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    </head>
    <body>
        @if ($account)
            <h1> Tester le compte {{ $account->webProperty_name}} ({{ $account->webProperty_id }}) -> {{ $account->profile_name }}  </h1>

            <p> Nombre de sessions ces 7 derniers jours : {{ $nb_sessions }} </p>

        @endif
            <br /><br /><a href="{{ URL::route('ga-accounts') }}">Retourner à la liste des comptes </a>

    </body>
</html>
