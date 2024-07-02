@foreach ($customers as $item)
    <option value="{{$item->id}}">{{$item->customer_company_name}}</option>
@endforeach