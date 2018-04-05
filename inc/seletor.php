<div class="seletor">
	<select name="event-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'> 
	    <option value="">Selecionar eixo</option>
	    <?php 
	        // $option = '<option value="' . get_option('home') . '/exposicao-virtual/">Ver toda exposição</option>';
	        $categories = get_categories(); 
	        foreach ($categories as $category) {
	            $option .= '<option value="'.get_option('home').'/exposicao-virtual/'.$category->slug.'">';
	            $option .= $category->cat_name;
	            // $option .= ' ('.$category->category_count.')';
	            $option .= '</option>';
	        }
	        echo $option;
	    ?>
	</select>
</div>