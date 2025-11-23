<x-layouts.mail :message="$message">
    <p style="color: #2a2627;">New ticket <b>"{{ $ticket->subject }}"</b> has been assigned to you in <b>{{ $ticket->workspace->name }}</b> workspace.</p>
    <p style="margin-top: 30px; color: #2a2627;">Here is the ticket description:</p>
    <div style="color: #2a2627;">{{ $ticket->description }}</div>
</x-layouts.mail>
