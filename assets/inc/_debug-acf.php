<?php
if (WP_ENV == 'development') {
    if (! class_exists('acf_field_debug')) {
        class acf_field_debug extends acf_field
        {
            public function initialize()
            {
                $this->name = 'debug';
                $this->label = __("Debug");
                $this->category = 'layout';
                $this->defaults = array(
                    'print'		=> 0,
                );
            }
            public function render_field($field)
            {
                global $post;
                $fields = get_fields($post->ID);
                $field_object = get_field_objects($post->ID);
                if ($field['print']) {
                    print_r($post);
                    print_r($fields);
                    print_r($field_object);
                } else {
                    var_dump($post);
                    var_dump($fields);
                    var_dump($field_object);
                }
            }
            public function render_field_settings($field)
            {
                acf_render_field_setting($field, array(
                    'label'			=> __('Print'),
                    'instructions'	=> __('Print instead of dump', 'acf'),
                    'name'			=> 'print',
                    'type'			=> 'true_false',
                    'ui'			=> 1,
                ));
            }
            public function load_field($field)
            {
                $field['name'] = '';
                $field['instructions'] = '';
                $field['required'] = 0;
                $field['value'] = false;
                return $field;
            }
        }
        acf_register_field_type('acf_field_debug');
    }

    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_debug',
            'title' => 'Debug',
            'fields' => array(
                array(
                    'key' => 'field_debug',
                    'label' => 'Debug',
                    'name' => 'debug',
                    'type' => 'debug',
                ),
            ),
            'location' => array(
                array(array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'post',
                ),),
                array(array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'page',
                ),),
                array(array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'product',
                ),),
                array(array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'shop_order',
                ),),
                array(array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'shop_coupon',
                ),),
                array(array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'store',
                ),),
            ),
            'menu_order' => 9999,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => array(),
            'active' => true,
            'description' => '',
        ));
    }
}
