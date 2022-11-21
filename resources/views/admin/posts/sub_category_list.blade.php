@if( $category->ProductCategory->count() > 0 )
	<li>
		<span class="caret">
			<div class="icheck-primary d-inline">
		        <input type="checkbox" name="categories[]" id="{{ str_replace(' ','-',$category->name) }}" value="{{ $category->id }}" {{ ( $row->postCategories->contains('category_id',$category->id) ) ? 'checked':'' }}>
		        <label for="{{ str_replace(' ','-',$category->name) }}">
		    	</label>
		    	{{ $category->name }}
		  	</div>
		</span>
		<ul class="nested">
			@foreach($category->ProductCategory as $subKey => $category2)
				@include('admin.posts.sub_category_list',['category' => $category2])
			@endforeach
		</ul>
	</li>
@else
	<li>
		<span class="caret2" style="margin-left: 30px;">
			<div class="icheck-primary d-inline">
		        <input type="checkbox" name="categories[]" id="{{ str_replace(' ','-',$category->name) }}" value="{{ $category->id }}" {{ ($row->postCategories->contains('category_id',$category->id)) ? 'checked':'' }}>
		        <label for="{{ str_replace(' ','-',$category->name) }}">
		    	</label>
		    	{{ $category->name }}
		  	</div>
	  	</span>
	</li>
@endif