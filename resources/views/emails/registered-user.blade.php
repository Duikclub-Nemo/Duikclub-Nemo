<x-email-layout title="Duikclub Nemo | Nieuw lid"
                preheader="Er is een nieuw lid geregistreerd.">

    <x-slot:header>
        <x-email-header/>
    </x-slot:header>

    <x-email-paragraph>
        Beste {{ $notifiable->first_name }},
    </x-email-paragraph>

    <x-email-paragraph>
        Een nieuw lid heef zich geregistreerd op {{ config('app.name') }}.<br>
        Klik op de onderstaande knop om het lid te activeren.
    </x-email-paragraph>

    <x-email-button :url="$url">
        Lid activeren
    </x-email-button>

    <x-email-panel>
        <x-email-heading level="4">
            Persoons- en adresgegevens
        </x-email-heading>
        <table width="100%">
            <tr>
                <td width="35%">Naam</td>
                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
            </tr>
            <tr>
                <td>Adres</td>
                <td>{{ $user->street }}</td>
            </tr>
            <tr>
                <td></td>
                <td>{{ $user->zipcode }} {{ $user->place }} ({{ $user->country->code }})</td>
            </tr>
            <tr>
                <td>E-mailadres</td>
                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
            </tr>
            <tr>
                <td>Telefoonnummer</td>
                <td>{{ $user->phone_number }}</td>
            </tr>
        </table>
    </x-email-panel>

    <x-email-subcopy :url="$url">
        Als je problemen hebt met het klikken op de "Lid activeren" knop, kopieer en plak de URL hieronder in je
        webbrowser:
    </x-email-subcopy>

    <x-slot:footer>
        <x-email-footer/>
    </x-slot:footer>

</x-email-layout>
