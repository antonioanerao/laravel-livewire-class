<div class="card">
    <div class="card-body">
        <h3>Support Tickets</h3>

        @foreach($tickets as $ticket)
            <div class="card mb-3 {{ $active == $ticket->id ? 'bg-success' : '' }} " wire:click="$emit('ticketSelected', {{ $ticket->id }})">
                <div class="card-body">
                    {{ $ticket->question }}
                </div>
            </div>
        @endforeach
    </div>
</div>
