@if( $category->ProductCategory->count() > 0 )
	<li>
		<span class="caret">
			<div class="icheck-primary d-inline">
		  		{{ $category->name }}
		        <input type="radio" name="parent_id" id="{{ str_replace(' ','-',$category->name) }}" value="{{ $category->id }}" {{ ($category->id==$row->parent_id) ? 'checked':'' }}>
		        <label for="{{ str_replace(' ','-',$category->name) }}">
		    	</label>
		  	</div>
		</span>
		<ul class="nested">
			@foreach($category->ProductCategory as $subKey => $category2)
				@include('admin.categories.sub_category_list',['category' => $category2])
			@endforeach
		</ul>
	</li>
@else
	<li>
		<span class="caret">
			<div class="icheck-primary d-inline">
		  		{{ $category->name }}
		        <input type="radio" name="parent_id" id="{{ str_replace(' ','-',$category->name) }}" value="{{ $category->id }}" {{ ($category->id==$row->parent_id) ? 'checked':'' }}>
		        <label for="{{ str_replace(' ','-',$category->name) }}">
		    	</label>
		  	</div>
	  	</span>
	</li>
@endif