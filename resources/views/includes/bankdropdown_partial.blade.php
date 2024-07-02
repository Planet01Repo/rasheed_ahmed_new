@foreach ($bank_details as $item)
    <option value="{{$item->id}}">
        {{$item->branch_name}}/{{$item->account_number}}
    </option>
@endforeach