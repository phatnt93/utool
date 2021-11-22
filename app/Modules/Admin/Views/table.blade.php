@include('Admin::searchform')

<div class="table-responsive">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                @foreach ($thead as $th)
                    <th><?= $th ?></th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($tbody as $row)
                <tr>
                    @foreach ($row as $col)
                        <td><?= $col ?></td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
    {{ $pagination->links() }}
</div>