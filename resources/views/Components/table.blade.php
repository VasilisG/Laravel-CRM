<table class="table w-full table-auto border border-collapse">
  <thead class="bg-gray-600 text-white">
    <tr>
      @foreach($columns as $column)
        <th class="py-2 px-4 text-left">{{ $column['label'] }}</th>
      @endforeach
    </tr>
  </thead>
  <tbody>
    @if(count($data))
      @foreach($data as $item)
        <tr class="hover:bg-gray-200">
          @foreach($columns as $key => $value)
            @if($key === 'actions')
            <td class="py-4 px-4 text-left border-b border-gray-300">
              <a href="{{ $resource }}/{{ $item->id }}/edit" class="text-sky-600 hover:text-sky-700 px-2 py-1 flex items-center gap-2">
                <span class="inline-block w-[15px]"><x-icon-edit/></span>
                <span>Edit</span>
              </a>
            </td>
            @else
              @switch($value['type'])
                @case('string')
                  <td class="py-4 px-4 text-left border-b border-gray-300">{{ $item[$key] }}</td>
                  @break
                @case('boolean')
                  <td class="py-4 px-4 text-left border-b border-gray-300 font-bold {{ $item[$key] ? 'text-green-600' : 'text-red-800' }}">{{ $item[$key] ? 'Yes' : 'No' }}</td>
                  @break
                @case('currency')
                  <td class="py-4 px-4 text-left border-b border-gray-300 font-semibold">@currency($item[$key])</td>
                  @break
                @case('lookup')
                  <td class="py-4 px-4 text-left border-b border-gray-300">
                    <span class="py-1 px-2 text-white rounded {{ $value['lookup'][$item[$key]]['style'] }}">{{ $value['lookup'][$item[$key]]['label'] }}</span>
                  </td>
                  @break
                default
                  <td class="py-4 px-4 text-left border-b border-gray-300">{{ $item[$key] }}</td>
                  @break
              @endswitch
            @endif
          @endforeach
        </tr>
      @endforeach
    @else
      <td class="py-4 px-4 text-center border-b border-gray-300" colspan="{{ count($columns) }}">No data to show.</td>
    @endif
  </tbody>
</table>