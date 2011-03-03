<?php 
echo CHtml::beginForm(array('shoppingCart/create'));

echo CHtml::hiddenField('product_id', $model->product_id);
echo CHtml::label(Shop::t('Amount'), 'ShoppingCart_amount');
echo CHtml::textField('amount', 1, array('size' => 3));

echo '<br />';

if($variations = $model->getVariations()) {
	$i = 0;
	foreach($variations as $variation) {
		$i++;
		$field = "Variations[{$variation[0]->specification_id}][]";
		echo '<div class="product_variation product_variation_'.$i.'">';
		echo CHtml::label($variation[0]->specification->title, $field) . '<br />';
		if($variation[0]->specification->is_user_input) {
			echo CHtml::textField($field);
		}
		else {
			echo CHtml::radioButtonList($field,
					$variation[0]->id,
					ProductVariation::listData($variation));
		}
		echo '</div>';
		if($i % 3 == 0)
			echo '<div style="clear: both;"></div>';
	}

echo '<div style="clear: both;"></div>';

}
echo Shop::t('All prices are gross') . '<br />';
echo Shop::t('All prices excluding shipping costs') . '<br /><br />';

echo CHtml::submitButton(Shop::t('Add to shopping Cart')); 

echo CHtml::endForm();
?>
