<x-layouts.mail :message="$message">
    <p style="color: #2a2627;">New ticket <b>"{{ $ticket->subject }}"</b> has been created in <b>{{ $ticket->workspace->name }}</b> workspace.</p>
</x-layouts.mail>
