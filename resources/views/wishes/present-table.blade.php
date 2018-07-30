<div class="table-responsive">
    <table class="table table- present-table">
        <thead>
            <tr>
                <th>Stück</th>
                <th><i class="voyager-person"></i> von</th>
                <th><i class="voyager-calendar"></i> Abgabetermin</th>
                <th><i class="voyager-settings"></i> Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($wish->presents as $present)
            <tr>
                <td>{{ $present->amount }}x</td>
                <td>{{ $present->fromUser->name }}</td>
                <td>{{ $present->due_date->diffForHumans() }}</td>
                <td>{{ $present->getMessageState() }}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>