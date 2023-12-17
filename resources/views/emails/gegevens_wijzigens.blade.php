<!DOCTYPE html>

<html lang="en">


<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>


<body>
    <table>
        <thead>
            <tr>
                <th>{{ __('Relatienummer') }}</th>
                <th>{{ __('Naam Bedrijf') }}</th>
                <th>{{ __('Uw Naam') }}</th>
                <th>{{ __('Emailadres') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $data['relatienummer'] }}</td>
                <td>{{ $data['naam_bedrijf'] }}</td>
                <td>{{ $data['uw_naam'] }}</td>
                <td>{{ $data['emailadres'] }}</td>
            </tr>
        </tbody>
    </table>
</body>


</html>