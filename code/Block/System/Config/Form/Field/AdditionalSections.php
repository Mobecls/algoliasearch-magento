<?php

/**
 * Algolia custom sort order field.
 */
class Algolia_Algoliasearch_Block_System_Config_Form_Field_AdditionalSections extends Algolia_Algoliasearch_Block_System_Config_Form_Field_AbstractField
{
    public function __construct()
    {
        $this->settings = [
            'columns' => [
                'name' => [
                    'label'   => 'Section',
                    'options' => function () {
                        $options = [];

                        $sections = [
                            ['name' => 'pages', 'label' => 'Pages'],
                        ];

                        /** @var Algolia_Algoliasearch_Helper_Config $config */
                        $config = Mage::helper('algoliasearch/config');

                        $attributes = $config->getFacets();
                        foreach ($attributes as $attribute) {
                            if ($attribute['attribute'] == 'price' || $attribute['attribute'] == 'category' || $attribute['attribute'] == 'categories') {
                                continue;
                            }

                            $sections[] = [
                                'name'  => $attribute['attribute'],
                                'label' => $attribute['label'] ? $attribute['label'] : $attribute['attribute']
                            ];
                        }

                        foreach ($sections as $section) {
                            $options[$section['name']] = $section['label'];
                        }

                        return $options;
                    },
                    'rowMethod' => 'getName',
                    'width'     => 130,
                ],
                'label' => [
                    'label' => 'Label',
                    'style' => 'width: 100px;',
                ],
                'hitsPerPage' => [
                    'label' => 'Hits per page',
                    'style' => 'width: 100px;',
                    'class' => 'required-entry input-text validate-number',
                ],
            ],
            'buttonLabel' => 'Add Section',
            'addAfter'    => false,
        ];

        parent::__construct();
    }
}
