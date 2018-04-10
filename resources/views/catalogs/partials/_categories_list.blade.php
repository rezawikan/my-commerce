<section class="widget widget-categories">
  <h3 class="widget-title">Shop Categories</h3>
  <ul>
    {{-- @foreach ($mappings as $main => $sub)
      <li class="has-children expanded"><a href="#">{{ $main }}</a>
        <ul>
          @foreach ($sub as $key => $value)
            <li>
              <a href="{{ url("/catalogs/{$key}")}}">{{ $key }}</a>
              <span>({{ $value }})</span>
            </li>
          @endforeach
        </ul>
      </li>
    @endforeach --}}

  </ul>
</section>


{{-- <div class="list-group">
    @foreach($map as $value => $name)
        <a
            href="{{ route('courses.index', array_merge(request()->query(), [$key => $value, 'page' => 1])) }}"
            class="list-group-item{{ request($key) === $value ? ' active' : '' }}"
        >{{ $name }}</a>
    @endforeach

    @if(request($key))
        <a href="{{ route('courses.index', array_except(request()->query(), [$key, 'page'])) }}" class="list-group-item list-group-item-info">&times; Clear this filter</a>
    @endif
</div>


{{-- {{dd(App\Models\Category::NestedCategory())}} --}}
{{-- @foreach (App\Models\Category::NoParent()->get() as $category)
  <li class="has-children expanded"><a href="#">{{ $category->title }}</a>
    <ul>
    @foreach ($category->childs as $child)
          <li>
            <a href="{{ url("/catalogs/{$child->slug}")}}">{{ $child->title }}</a>
            <span>({{ $child->total_products }})</span>
          </li>
    @endforeach
    </ul>
  </li>
@endforeach  --}}
