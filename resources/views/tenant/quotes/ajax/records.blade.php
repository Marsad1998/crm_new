@foreach($leads as $lead)
<tr>
    <td>
        <input type="radio" name="lead" class="get-call-data"  value="{{$lead->id}}">
    </td>
    <td>{{$lead->id}}</td>
    <td>
        @if($lead->leadLatest)
            @if($lead->leadLatest->price && $lead->leadLatest->price->models)
                {{$lead->leadLatest->price->models->name}}
            @endif
        @else -
        @endif
    </td>
    <td>
        @if($lead->leadLatest)
            @if($lead->leadLatest->price && $lead->leadLatest->price->services)
                {{$lead->leadLatest->price->services->name}}
            @endif
        @else
        @endif
    </td>
    <td>
        {{date("D, d M Y H:i a", strtotime($lead->created_at))}}
    </td>
    <td>{{$lead->last_quoted}}</td>
    <td>{{$lead->notes}}</td>
    <td>
        @if($lead->callLog)
            {{$lead->callLog->status}}
        @else
            -
        @endif
    </td>
</tr>
@endforeach
<tr>
    <td><input type="radio" name="lead"></td>
    <td class="text-center" colspan="7">None of these, this a new lead.</td>
</tr>
