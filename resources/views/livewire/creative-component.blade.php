<div>
    <h2>Creative Manager</h2>

    @if($updateMode)
        <h4>Edit Creative</h4>
    @else
        <h4>Add New Creative</h4>
    @endif

    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
        <input type="text" wire:model="main_asset" placeholder="Main Asset" required>
        <input type="text" wire:model="logo" placeholder="Logo" required>
        <input type="text" wire:model="cta" placeholder="CTA" required>
        <input type="url" wire:model="url" placeholder="URL">
        <input type="number" wire:model="position" placeholder="Position" required>

        <button type="submit">{{ $updateMode ? 'Update' : 'Save' }}</button>
        <button type="button" wire:click="resetInputFields">Cancel</button>
    </form>

    <h3>Creative List</h3>
    <ul>
        @foreach($creatives as $creative)
            <li>
                {{ $creative->main_asset }} - {{ $creative->logo }} - {{ $creative->cta }} - {{ $creative->url }} - Position: {{ $creative->position }}
                <button wire:click="edit({{ $creative->id }})">Edit</button>
            </li>
        @endforeach
    </ul>
</div>
