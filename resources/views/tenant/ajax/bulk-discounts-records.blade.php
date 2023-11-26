@foreach($discounts as $discount)
    <tr>
        <th scope="row">{{ ($discount->KeyType) ? $discount->KeyType->name : '-' }}</th>
        <td>{{$discount->key_number}}</td>
        <td>{{$discount->multiplier}}%</td>
        <td>
            @if($discount->state == 1)
                <span class="tag tag-success">Active</span>
            @else
                <span class="text-muted">Inactive</span>
            @endif
        </td>
        <td>
            <button class="btn btn-primary toggleBtn" data-id="{{$discount->id}}" type="button">Toggle State</button>
        </td>
    </tr>
@endforeach
