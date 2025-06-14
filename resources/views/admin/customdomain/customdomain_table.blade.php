<table class="table">
    <thead>
        <tr class="text-capitalize fs-15 fw-500">
            <td>{{ trans('labels.requested_domain') }}</td>
            <td>{{ trans('labels.current_domain') }}</td>
            <td>{{ trans('labels.status') }}</td>
        </tr>
    </thead>
    <tbody>
        <tr class="border fs-7 align-middle">
            <td>{{ empty(@$domain->requested_domain) ? '-' : @$domain->requested_domain }}</td>
            <td>{{ empty(@$domain->current_domain) ? '-' : @$domain->current_domain }}</td>
            <td class="{{ @$domain->status == 1 ? 'text-warning' : 'text-success' }}">
                @if (@$domain->status == 1)
                <span class="badge bg-warning">{{ trans('labels.pending') }} </span>
                @elseif(@$domain->status == 2)
                <span class="badge bg-success">{{ trans('labels.connected') }} </span>
                @else
                    -
                @endif
            </td>
        </tr>
    </tbody>
</table>
