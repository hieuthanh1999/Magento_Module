<?php

namespace AHT\ProductOrderGrid\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\DynamicRows;
use Magento\Framework\Phrase;

use Magento\Ui\Component\Form\Element\DataType\Number;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Ui\Component\Container;
use Magento\Ui\Component\Form\Element\ActionDelete;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Sales\Api\OrderRepositoryInterface;

class CustomTab extends AbstractModifier
{
const FIELD_IS_DELETE = 'is_delete';
const FIELD_SORT_ORDER_NAME = 'sort_order';
const FIELD_NAME_SELECT = 'select_field';

protected $connection;
private $locator;

public function __construct(
LocatorInterface $locator,
\Magento\Framework\App\ResourceConnection $resource

)
{
$this->locator = $locator;
$this->connection = $resource->getConnection();
}

public function modifyData(array $data)
{
$data = null;
/** @var \Magento\Catalog\Model\Product $product */
$product = $this->locator->getProduct();
$productId = $product->getId();

$query = $this->connection->fetchAll("SELECT increment_id, store_name , created_at, billing_name, 
shipping_name, base_grand_total,
grand_total, status FROM sales_order_grid WHERE increment_id = $productId");

$arr = [
'increment_id' => $query[0]['increment_id'],
'store_name' => $query[0]['store_name'],
'created_at' =>$query[0]['created_at'],
'billing_name' => $query[0]['billing_name'],
'shipping_name' => $query[0]['shipping_name'],
'base_grand_total' => $query[0]['base_grand_total'],
'grand_total' => $query[0]['grand_total'],
'status' => $query[0]['status'],
];
$data['links']= $arr;
return $data['links'];
}

public function modifyMeta(array $meta)
{
$meta = array_replace_recursive(
$meta,
[
'custom_fieldset' => [
'arguments' => [
'data' => [
'config' => [
'label' => __('Order'),
'componentType' => Fieldset::NAME,
'dataScope' => 'data.product.custom_fieldset',
'collapsible' => true,
'sortOrder' => 5,
],
],
],
'children' => [
"custom_field" => $this->getSelectTypeGridConfig(10)
],
]
]
);
return $meta;
}
protected function getSelectTypeGridConfig($sortOrder)
{
return [
'arguments' => [
'data' => [
'config' => [
'addButtonLabel' => __('Add Value'),
'componentType' => DynamicRows::NAME,
'component' => 'Magento_Ui/js/dynamic-rows/dynamic-rows',
'additionalClasses' => 'admin__field-wide',
'deleteProperty' => static::FIELD_IS_DELETE,
'deleteValue' => '1',
'renderDefaultRecord' => false,
'sortOrder' => $sortOrder,
],
],
],
'children' => [
'record' => [
'arguments' => [
'data' => [
'config' => [
'componentType' => Container::NAME,
'component' => 'Magento_Ui/js/dynamic-rows/record',
'positionProvider' => static::FIELD_SORT_ORDER_NAME,
'isTemplate' => true,
'is_collection' => true,
],
],
],
'children' => [
static::FIELD_NAME_SELECT => $this->getSelectFieldConfig(1),
static::FIELD_IS_DELETE => $this->getIsDeleteFieldConfig(3)
//Add as many fields as you want

]
]
]
];
}

protected function getSelectFieldConfig($sortOrder)
{
return [
'arguments' => [
'data' => [
'config' => [
'additionalClasses' => 'admin__field-wide',
'componentType' => DynamicRows::NAME,
'label' => null,
'columnsHeader' => false,
'columnsHeaderAfterRender' => true,
'renderDefaultRecord' => false,
'template' => 'ui/dynamic-rows/templates/grid',
'component' => 'Magento_Ui/js/dynamic-rows/dynamic-rows-grid',
'addButton' => false,
'recordTemplate' => 'record',
'dataScope' => 'data.links',
// 'deleteButtonLabel' => __('Remove'),
/// 'dataProvider' => $dataProvider,
'map' => [
'increment_id' => 'increment_id ',
'store_name' => 'store_name',
'created_at' => 'created_at',
'billing_name' => 'billing_name',
'shipping_name' => 'shipping_name',
'base_grand_total' => 'base_grand_total',
'grand_total' => 'grand_total',
'status' => 'status',
],
'links' => [
'insertData' => '${ $.provider }:${ $.dataProvider }'
],
'sortOrder' => $sortOrder,
],
],
],
'children' => [
'record' => [
'arguments' => [
'data' => [
'config' => [
'componentType' => 'container',
'isTemplate' => true,
'is_collection' => true,
'component' => 'Magento_Ui/js/dynamic-rows/record',
'dataScope' => '',
],
],
],
'children' => $this->fillMeta(),
],
],
];
}

protected function fillMeta()
{
return [
'increment_id' => $this->getTextColumn('increment_id', false, __('ID'), 10),
'store_name' => $this->getTextColumn('store_name', false, __('Purchase Point'), 20),
'created_at' => $this->getTextColumn('created_at', true, __('Purchase Date'), 30),
'billing_name' => $this->getTextColumn('billing_name', false, __('Bill-to Name'), 40),
'shipping_name' => $this->getTextColumn('shipping_name', true, __('Ship-to Name'), 50),
'base_grand_total' => $this->getTextColumn('base_grand_total', true, __('Grant total (Base)'), 60),
'grand_total' => $this->getTextColumn('grand_total', true, __('Grant total (Purchase)'), 70),
'status' => $this->getTextColumn('status', true, __('Status'), 80),
// 'actionDelete' => [
// 'arguments' => [
// 'data' => [
// 'config' => [
// 'additionalClasses' => 'data-grid-actions-cell',
// 'componentType' => 'actionDelete',
// 'dataType' => Text::NAME,
// 'label' => __('Actions'),
// 'sortOrder' => 70,
// 'fit' => true,
// ],
// ],
// ],
// ],
// 'position' => [
// 'arguments' => [
// 'data' => [
// 'config' => [
// 'dataType' => Number::NAME,
// 'formElement' => Input::NAME,
// 'componentType' => Field::NAME,
// 'dataScope' => 'position',
// 'sortOrder' => 80,
// 'visible' => false,
// ],
// ],
// ],
// ],
];
}

protected function getTextColumn($dataScope, $fit, Phrase $label, $sortOrder)
{
$column = [
'arguments' => [
'data' => [
'config' => [
'componentType' => Field::NAME,
'formElement' => Input::NAME,
'elementTmpl' => 'ui/dynamic-rows/cells/text',
'component' => 'Magento_Ui/js/form/element/text',
'dataType' => Text::NAME,
'dataScope' => $dataScope,
'fit' => $fit,
'label' => $label,
'sortOrder' => $sortOrder,
],
],
],
];

return $column;
}

// protected function _getOptions()
// {
// $options = [
// 1 => [
// 'label' => __('Option 1'),
// 'value' => 1
// ],
// 2 => [
// 'label' => __('Option 2'),
// 'value' => 2
// ],
// 3 => [
// 'label' => __('Option 3'),
// 'value' => 3
// ],
// ];

// return $options;
// }
protected function getIsDeleteFieldConfig($sortOrder)
{
return [
'arguments' => [
'data' => [
'config' => [
'componentType' => ActionDelete::NAME,
'fit' => true,
'sortOrder' => $sortOrder
],
],
],
];
}
}