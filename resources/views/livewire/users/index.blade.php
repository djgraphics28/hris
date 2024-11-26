@php
    // Define the table headers
    $heads = [
        ['label' => 'ID', 'width' => 10],
        ['label' => 'Name', 'width' => 40],
        ['label' => 'Email', 'width' => 20],
        ['label' => 'Role', 'width' => 15],
        ['label' => 'Status', 'width' => 15],
        ['label' => 'Actions', 'no-export' => true, 'width' => 5],
    ];

    // Initialize the data for the table
    $data = [];

    // Loop through each user and populate the data array
    foreach ($users as $user) {
        $btnEdit =
            '<button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#editModal" data-user-id="' .
            $user->id .
            '">Edit</button>';
        $btnDelete = '<button class="btn btn-xs btn-danger" onclick="confirmDelete(' . $user->id . ')">Delete</button>';
        $btnDetails = '<button class="btn btn-xs btn-info" onclick="viewDetails(' . $user->id . ')">Details</button>';

        // Push each user's data including actions to the $data array
    $data[] = [
        $user->id,
        $user->name,
        $user->email,
        $user->role,
        $user->status,
        '<nobr>' . $btnEdit . ' ' . $btnDelete . ' ' . $btnDetails . '</nobr>',
    ];
}

// Configure the table using the generated data
$config = [
    'data' => $data,
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, null, null, ['orderable' => false]],
    ];
@endphp

<div>
    <x-adminlte-card title="Filters" class="collapsed-card" theme="secondary" icon="fas fa-lg fa-search"
        collapsible="collapsed">
        <form wire:submit.prevent="filter">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Status</label>
                    <x-adminlte-select2 name="filterByStatus" multiple>
                        <option disabled>Choose</option>
                        <option value="1">Active</option>
                        <option value="0">Deactivated</option>
                    </x-adminlte-select2>
                </div>
            </div>
            <x-adminlte-button type="submit" label="Submit Filter" data-toggle="modal" class="bg-primary" />
        </form>
    </x-adminlte-card>

    <x-adminlte-button label="Add New" data-toggle="modal" data-target="#addModal" class="bg-info float-right mb-3" />

    <x-adminlte-datatable id="table5" :heads="$heads" :config="$config" theme="light" striped hoverable
        with-buttons />

    {{-- With buttons + customization --}}
    @php
        $config['dom'] = '<"row" <"col-sm-7" B> <"col-sm-5 d-flex justify-content-end" i> >
                  <"row" <"col-12" tr> >
                  <"row" <"col-sm-12 d-flex justify-content-start" f> >';
        $config['paging'] = false;
        $config['lengthMenu'] = [10, 50, 100, 500];
    @endphp

    <x-adminlte-modal id="addModal" title="Add New User" theme="info" icon="fas fa-user-profile" size='xl'
        disable-animations scrollable>
        <form wire:submit.prevent>
            <div class="row">
                <x-adminlte-input name="name" label="Name" placeholder="ex. Juan dela Cruz" fgroup-class="col-md-6"
                    disable-feedback />

                <x-adminlte-input name="email" label="Email Address" placeholder="ex. juandelacruz@mail.com"
                    fgroup-class="col-md-6" disable-feedback />

                <x-adminlte-select2 name="roles" label="Roles" fgroup-class="col-md-6" multiple>
                    <option disabled>Choose</option>
                </x-adminlte-select2>

                <x-adminlte-select2 name="businesses" label="Business(es) Handle" fgroup-class="col-md-6" multiple>
                    <option disabled>Choose</option>
                </x-adminlte-select2>
            </div>

            <x-slot name="footerSlot">
                <x-adminlte-button class="mr-auto" theme="info" label="Save" />
                <x-adminlte-button theme="secondary" label="Close" data-dismiss="modal" />
            </x-slot>
        </form>
    </x-adminlte-modal>

    <x-adminlte-modal id="editModal" title="Edit User" theme="warning" icon="fas fa-user-profile" size='xl'
        disable-animations>
        This is a purple theme modal without animations.
    </x-adminlte-modal>
</div>
