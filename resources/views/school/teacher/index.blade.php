<table>
    @if(!empty($items))
        @foreach($items as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
            </tr>
        @endforeach
    @endif
</table>
