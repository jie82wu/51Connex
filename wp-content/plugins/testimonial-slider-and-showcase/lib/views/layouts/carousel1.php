<?php
$level = array();
if(in_array( 'designation', $items ) && $designation) {
	$level[] = "<span class='author-designation'>".esc_html($designation)."</span>";
}
if(in_array( 'company', $items ) && $company) {
	$level[] = "<span class='item-company'>".esc_html($company)."</span>";
}
if(in_array( 'location', $items ) && $location) {
	$level[] = "<span class='author-location'>".esc_html($location)."</span>";
}
$html = null;
$html .= "<div class='{$grid} {$class}'>";
	$html .= "<div class='single-item-wrapper11'>";
		
		
		if(in_array( 'testimonial', $items ) && $testimonial) {
			$html .= "<div class='testi-text'><p>".$testimonial."</p></div>";
		}
		
		$html .= '<div class="item-content-wrapper">';
		if(in_array( 'author', $items ) && $author) {
			$html .= "<div class='testi-btm'><div class='testi-about'><span><span>".esc_html($author)."</span>";
		}
		if(!empty($level)){
			$level = array_filter($level);
			$levelList = implode(', ', $level);
			$html .= strip_tags($levelList).'</span>';
		}
		if(in_array( 'author_img', $items )) {
			$html .= "{$img}</div></div>";
		}
		$html .= '</div>';
    $html .= '</div>';
$html .= '</div>';
return $html;
